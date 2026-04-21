<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colors_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Color extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Colors_model::orderBy('id', 'DESC')->where('d_status', 0)->get();

        // foreach ($this->data['rows'] as $row) {
        //     $row->cat_name = $row->category_row->name;
        // }

        return view('admin.colors.index', $this->data);
    }
    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $data = array();



            for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {
                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/colors/');

                    if (!empty(basename($image))) {
                        $data[$field] = basename($image);
                    }
                }
            }



            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            if (!empty($input['featured'])) {
                $data['featured'] = 1;
            } else {
                $data['featured'] = 0;
            }
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];
            $data['name'] = $input['name'];
            // $data['heading'] = $input['heading'];
            // $data['delivery_time'] = $input['delivery_time'];
            // $data['description'] = $input['description'];
            // $data['about_return'] = $input['about_return'];



            // $data['price'] = $input['price'];
            // $data['qty'] = $input['qty'];
            $data['slug'] = checkSlug(Str::slug($data['name'], '-'), 'colors');
            $data['description'] = $input['description'];
     



            $id = Colors_model::create($data)->id;
            $this->saveGalleryRepeater($id, $input);
      



            return redirect('admin/colors/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;

        return view('admin.colors.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $product = Colors_model::find($id);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $data = array();



            for ($i = 1; $i <= 10; $i++) {
                $field = 'image' . $i;

                if ($request->hasFile($field)) {

                    $request->validate([
                        $field => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);

                    $image = $request->file($field)->store('public/colors/');

                    if (!empty($image)) {
                        // Old image delete karne ka logic
                        $oldImageField = 'image' . $i;
                        if (!empty($product->$oldImageField)) {
                            removeImage("products/" . $product->$oldImageField);
                        }

                        // New image assign karna
                        $product->$oldImageField = basename($image);
                    }
                }
            }



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
            // $product->heading = $input['heading'];
            // $product->delivery_time = $input['delivery_time'];
            $product->description = $input['description'];
            // $product->about_return = $input['about_return'];



            // $product->price = $input['price'];
            // $product->qty = $input['qty'];
            $product->slug = checkSlug(Str::slug($product->name, '-'), 'colors', $product->id);
            // $product->detail = $input['detail'];


            // $product->category = $input['category'];


            $product->update();
            $this->saveGalleryRepeater($product->id, $input);
       




            return redirect('admin/colors/edit/' . $request->segment(4))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Colors_model::find($id);
        $this->data['enable_editor'] = true;

        return view('admin.colors.index', $this->data);
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
                    $image->storeAs('colors', $imageName, 'public');
                } elseif ($coverId) {
                    $existing = DB::table('colors_gallery')->where('id', $coverId)->first();
                    $imageName = $existing->cover_image ?? null;
                }

                if ($coverId) {
                    DB::table('colors_gallery')->where('id', $coverId)->update([
                        'title' => $cover_name,
                        'order_no' => $input['g_order_no'][$i] ?? 0,
                        'cover_image' => $imageName,
                        'updated_at' => now(),
                    ]);
                    $processedIds[] = $coverId;
                } else {
                    $newId = DB::table('colors_gallery')->insertGetId([
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

        DB::table('colors_gallery')
            ->where('product_id', $productId)
            ->whereNotIn('id', $processedIds)
            ->delete();
    }



   


    public function delete($id)
    {
        has_access(17);
        $product = Colors_model::find($id);
        $product->d_status = 1;
        // if (!empty($product->image)) {
        //     removeImage("products/" . $product->image);
        // }
        $product->update();
        return redirect('admin/colors/')
            ->with('error', 'Content deleted Successfully');
    }
}
