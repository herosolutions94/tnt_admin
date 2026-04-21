<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stick_Built_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Built extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Stick_Built_model::orderBy('id', 'DESC')->where('d_status', 0)->get();

        // foreach ($this->data['rows'] as $row) {
        //     $row->cat_name = $row->category_row->name;
        // }

        return view('admin.stick-built.index', $this->data);
    }
    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();

        if ($input) {
            $content  = $request->all();



         


          
            $data = [
                'slug' => checkSlug(Str::slug($input['name'], '-'), 'renaissance'),
                'meta_title' => $input['meta_title'] ?? '',
                'meta_description' => $input['meta_description'] ?? '',
                'meta_keywords' => $input['meta_keywords'] ?? '',
                'name' => $input['name'] ?? '',
                'sec1_heading' => $input['sec1_heading'] ?? '',
                'sec2_heading' => $input['sec2_heading'] ?? '',
                'description' => $input['description'] ?? '',
                'status' => !empty($input['status']) ? 1 : 0,
                'featured' => !empty($input['featured']) ? 1 : 0,
                'content' => json_encode($content), 
            ];

               for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/stick/');

                    if (!empty(basename($image))) {
                        $data[$field] = basename($image);
                    }
                }
            }







            $id = Stick_Built_model::create($data)->id;
            $this->saveGalleryRepeater($id, $input);
            $this->saveFaqsRepeater($id, $input);

            $this->savefeatureRepeater($id, $input);
            $this->saveDesignRepeater($id, $input);



            return redirect('admin/stick-built/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;

        return view('admin.stick-built.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $product = Stick_Built_model::find($id);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $content = json_decode($product->content, true) ?? [];




            for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/stick/');

                    if (!empty($image)) {
                        $oldImage = $content[$field] ?? null;
                        if (!empty($oldImage)) {
                            removeImage("stick/" . $oldImage);
                        }
                        $product->$field = basename($image);
                    }
                }
            }

            $otherInputs = $request->except(array_map(fn($i) => 'image' . $i, range(1, 10)));

            $explicitFields = ['status', 'featured', 'meta_title', 'meta_description', 'meta_keywords', 'name', 'title', 'description'];
            foreach ($explicitFields as $field) {
                unset($otherInputs[$field]);
            }

            $content = array_merge($content, $otherInputs);



            if (!empty($input['status'])) {
                $product->status = 1;
            } else {
                $product->status = 0;
            }

            if (!empty($input['featured'])) {
                $product->featured = 1;
            } else {
                $product->featured = 0;
            }
            $product->meta_title = $input['meta_title'];
            $product->meta_description = $input['meta_description'];
            $product->meta_keywords = $input['meta_keywords'];
            $product->name = $input['name'];
            // $product->title = $input['title'];
            // $product->heading = $input['heading'];
            // $product->delivery_time = $input['delivery_time'];
            $product->description = $input['description'];
            $product->sec2_heading = $input['sec2_heading'];
            $product->sec1_heading = $input['sec1_heading'];
            // $product->about_return = $input['about_return'];



            // $product->price = $input['price'];
            // $product->qty = $input['qty'];
            $product->slug = checkSlug(Str::slug($product->name, '-'), 'renaissance', $product->id);
            $product->content = json_encode($content);

            // $product->detail = $input['detail'];


            // $product->category = $input['category'];


            $product->update();
            $this->saveFaqsRepeater($product->id, $input);

            $this->saveGalleryRepeater($product->id, $input);
            $this->savefeatureRepeater($product->id, $input);
            $this->saveDesignRepeater($product->id, $input);




            return redirect('admin/stick-built/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Stick_Built_model::find($id);
        if (!empty($this->data['row']->content)) {
            $this->data['content'] = json_decode($this->data['row']->content, true);
        }

        $this->data['enable_editor'] = true;

        return view('admin.stick-built.index', $this->data);
    }

    public function saveGalleryRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['gallery_name'])) {
            foreach ($input['gallery_name'] as $i => $cover_name) {
                $imageName = null;
                $coverId = $input['gallery_id'][$i] ?? null;

                if (isset($input['gallery_image'][$i]) && $input['gallery_image'][$i]->isValid()) {
                    $image = $input['gallery_image'][$i];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('stick', $imageName, 'public');
                } elseif ($coverId) {
                    $existing = DB::table('stick_built_gallery')->where('id', $coverId)->first();
                    $imageName = $existing->cover_image ?? null;
                }

                if ($coverId) {
                    DB::table('stick_built_gallery')->where('id', $coverId)->update([
                        'title' => $cover_name,
                        'order_no' => $input['g_order_no'][$i] ?? 0,
                        'cover_image' => $imageName,
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $coverId;
                } else {
                    $newId = DB::table('stick_built_gallery')->insertGetId([
                        'product_id' => $productId,
                        'title' => $cover_name,
                        'order_no' => $input['g_order_no'][$i] ?? 0,
                        'cover_image' => $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('stick_built_gallery')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function saveFaqsRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['question'])) {
            foreach ($input['question'] as $i => $question) {
                $answer = $input['answer'][$i] ?? '';
                $orderNo = $input['q_order_no'][$i] ?? 0;
                $faqId = $input['faq_id'][$i] ?? null;



                if ($faqId && is_numeric($faqId)) {
                    // Update existing
                    DB::table('stick_built_faqs')->where('id', $faqId)->update([
                        'product_id' => $productId,
                        'question' => $question,
                        'answer' => $answer,
                        'order_no' => $orderNo,
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $faqId;
                } else {

                    $newId = DB::table('stick_built_faqs')->insertGetId([
                        'product_id' => $productId,
                        'question' => $question,
                        'answer' => $answer,
                        'order_no' => $orderNo,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        // Delete removed faqs
        DB::table('stick_built_faqs')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }




    public function savefeatureRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['colour_name'])) {
            foreach ($input['colour_name'] as $i => $colour_name) {
                $imageName = null;
                $colourId = $input['colour_id'][$i] ?? null;
                $detail = $input['detail'][$i] ?? null;

                // pr($colourId);


                // if (isset($input['colour_image'][$i]) && $input['colour_image'][$i]->isValid()) {
                //     $image = $input['colour_image'][$i];
                //     $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                //     $image->storeAs('aviva', $imageName, 'public');
                // } elseif ($colourId) {
                //     $existing = DB::table('aviva_colours')->where('id', $colourId)->first();
                //     $imageName = $existing->colour_image ?? null;
                // }

                if ($colourId) {
                    DB::table('stick_built_feature')->where('id', $colourId)->update([
                        'title' => $colour_name,
                        'order_no' => $input['f_order_no'][$i] ?? 0,
                        'detail' => $detail,

                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $colourId;
                } else {
                    $newId = DB::table('stick_built_feature')->insertGetId([
                        'product_id' => $productId,
                        'title' => $colour_name,
                        'order_no' => $input['f_order_no'][$i] ?? 0,
                        'detail' => $detail,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('stick_built_feature')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }

    public function saveTypeRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['type_name'])) {
            foreach ($input['type_name'] as $i => $colour_name) {
                $imageName = null;
                $colourId = $input['type_id'][$i] ?? null;

                // pr($colourId);




                if ($colourId) {
                    DB::table('product_type')->where('id', $colourId)->update([
                        'title' => $colour_name,
                        'order_no' => $input['d_order_no'][$i] ?? 0,

                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $colourId;
                } else {
                    $newId = DB::table('product_type')->insertGetId([
                        'product_id' => $productId,
                        'title' => $colour_name,
                        'order_no' => $input['d_order_no'][$i] ?? 0,

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('product_type')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function saveDesignRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['size_name'])) {
            foreach ($input['size_name'] as $i => $size_name) {
                $imageName = null;
                $sizeId = $input['size_id'][$i] ?? null;

                // pr($sizeId);


                if (isset($input['size_image'][$i]) && $input['size_image'][$i]->isValid()) {
                    $image = $input['size_image'][$i];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('stick', $imageName, 'public');
                } elseif ($sizeId) {
                    $existing = DB::table('stick_built_designs')->where('id', $sizeId)->first();
                    $imageName = $existing->size_image ?? null;
                }

                if ($sizeId) {
                    DB::table('stick_built_designs')->where('id', $sizeId)->update([
                        'title' => $size_name,
                        'order_no' => $input['d_order_no'][$i] ?? 0,
                        'size_image' => $imageName,

                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $sizeId;
                } else {
                    $newId = DB::table('stick_built_designs')->insertGetId([
                        'product_id' => $productId,
                        'title' => $size_name,
                        'order_no' => $input['d_order_no'][$i] ?? 0,
                        'size_image' => $imageName,

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('stick_built_designs')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function delete($id)
    {
        has_access(17);
        $product = Stick_Built_model::find($id);
        $product->d_status = 1;
        // if (!empty($product->image)) {
        //     removeImage("products/" . $product->image);
        // }
        $product->update();
        return redirect('admin/stick-built/')
            ->with('error', 'Content deleted Successfully');
    }
}
