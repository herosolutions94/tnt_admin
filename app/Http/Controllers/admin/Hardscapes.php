<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hardscapes_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Hardscapes extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Hardscapes_model::orderBy('id', 'DESC')
            ->where('d_status', 0)
            ->get();

        foreach ($this->data['rows'] as $row) {
            $row->content_data = json_decode($row->content, true);
        }



        return view('admin.hardscapes.index', $this->data);
    }

    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $content  = $request->all();






            
            $data = [
                'slug' => checkSlug(Str::slug($content['name'], '-'), 'aviva'),
                'meta_title' => $input['meta_title'] ?? '',
                'meta_description' => $input['meta_description'] ?? '',
                'meta_keywords' => $input['meta_keywords'] ?? '',
                'name' => $input['name'] ?? '',
                'description' => $input['description'] ?? '',
                'status' => !empty($input['status']) ? 1 : 0,
                'featured' => !empty($input['featured']) ? 1 : 0
            ];

            for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/hardscapes/');
                    $filename = basename($image);

                    if (!empty($filename)) {
                        if ($i == 1) {
                            $data[$field] = $filename;
                        }
                        $content[$field] = $filename;
                    }
                }
            }

            $data['content'] = json_encode($content);






            $id = Hardscapes_model::create($data)->id;
            $this->saveSpecificationRepeater($id, $input);
            $this->saveDesignRepeater($id, $input);



            return redirect('admin/hardscapes/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;

        return view('admin.hardscapes.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $product = Hardscapes_model::find($id);
        $input = $request->all();

        if ($input) {
            $content = json_decode($product->content, true) ?? [];

            for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/hardscapes/');

                    if (!empty($image)) {
                        $oldImage = $content[$field] ?? null;
                        if (!empty($oldImage)) {
                            removeImage("hardscapes/" . $oldImage);
                        }
                        if ($i == 1) {
                            $product->image1 = basename($image);
                        }
                        $content[$field] = basename($image);
                    }
                }
            }

            $otherInputs = $request->except(array_map(fn($i) => 'image' . $i, range(1, 10)));

            $explicitFields = ['status', 'featured', 'meta_title', 'meta_description', 'meta_keywords', 'name', 'title', 'description'];
            foreach ($explicitFields as $field) {
                unset($otherInputs[$field]);
            }

            $content = array_merge($content, $otherInputs);

            $content['status'] = !empty($input['status']) ? 1 : 0;
            $content['featured'] = !empty($input['featured']) ? 1 : 0;
            $content['meta_title'] = $input['meta_title'] ?? '';
            $content['meta_description'] = $input['meta_description'] ?? '';
            $content['meta_keywords'] = $input['meta_keywords'] ?? '';
            $content['name'] = $input['name'] ?? '';
            $content['description'] = $input['description'] ?? '';

            $product->slug = checkSlug(Str::slug($content['name'], '-'), 'hardscapes', $product->id);

            $product->content = json_encode($content);
            $product->update();

            $this->saveSpecificationRepeater($product->id, $input);
            $this->saveDesignRepeater($product->id, $input);

            return redirect('admin/hardscapes/edit/' . $id)
                ->with('success', 'Content Updated Successfully');
        }





        $this->data['row'] = $product;

        if (!empty($this->data['row']->content)) {
            $this->data['content'] = json_decode($this->data['row']->content, true);
        }

        $this->data['enable_editor'] = true;


        return view('admin.hardscapes.index', $this->data);
    }


    public function saveSpecificationRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['cover_name'])) {
            foreach ($input['cover_name'] as $i => $cover_name) {
                $imageName = null;
                $coverId = $input['cover_id'][$i] ?? null;

                if (isset($input['cover_image'][$i]) && $input['cover_image'][$i]->isValid()) {
                    $image = $input['cover_image'][$i];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('hardscapes', $imageName, 'public');
                } elseif ($coverId) {
                    $existing = DB::table('hardscapes_specifiy')->where('id', $coverId)->first();
                    $imageName = $existing->size_image ?? null;
                }

                if ($coverId) {
                    DB::table('hardscapes_specifiy')->where('id', $coverId)->update([
                        'title' => $cover_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'size_image' => $imageName,
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $coverId;
                } else {
                    $newId = DB::table('hardscapes_specifiy')->insertGetId([
                        'product_id' => $productId,
                        'title' => $cover_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'size_image' => $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('hardscapes_specifiy')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }







    public function saveDesignRepeater($productId, $input)
    {
        $processedIds = [];

        if (!empty($input['gallery_name'])) {
            foreach ($input['gallery_name'] as $i => $size_name) {
                $imageName = null;
                $sizeId = $input['gallery_id'][$i] ?? null;

                // pr($sizeId);


                if (isset($input['gallery_image'][$i]) && $input['gallery_image'][$i]->isValid()) {
                    $image = $input['gallery_image'][$i];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('hardscapes', $imageName, 'public');
                } elseif ($sizeId) {
                    $existing = DB::table('hardscapes_gallery')->where('id', $sizeId)->first();
                    $imageName = $existing->cover_image ?? null;
                }

                if ($sizeId) {
                    DB::table('hardscapes_gallery')->where('id', $sizeId)->update([
                        'title' => $size_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'cover_image' => $imageName,

                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $sizeId;
                } else {
                    $newId = DB::table('hardscapes_gallery')->insertGetId([
                        'product_id' => $productId,
                        'title' => $size_name,
                        'order_no' => $input['order_no'][$i] ?? 0,
                        'cover_image' => $imageName,

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $newId;
                }
            }
        }

        DB::table('hardscapes_gallery')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }


    public function delete($id)
    {
        has_access(17);
        $product = Hardscapes_model::find($id);
        $product->d_status = 1;
        // if (!empty($product->image)) {
        //     removeImage("products/" . $product->image);
        // }
        $product->update();
        return redirect('admin/hardscapes/')
            ->with('error', 'Content deleted Successfully');
    }
}
