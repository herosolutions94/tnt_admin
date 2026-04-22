<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Work_videos_model;
use App\Http\Controllers\Controller;

class Work_videos extends Controller
{
    public function index()
    {
        $this->data['rows'] = Work_videos_model::orderBy('id', 'DESC')->get();
        return view('admin.work_videos.index', $this->data);
    }

    public function add(Request $request)
    {
        $input = $request->all();
        if ($input) {
            $data = [];
            if ($request->hasFile('video')) {
                $request->validate([
                    'video' => 'mimes:mp4,mov,avi,wmv,webm|max:500000'
                ]);
                $video = $request->file('video')->store('public/work_videos/');
                if (!empty(basename($video))) {
                    $data['video'] = basename($video);
                }
            }
            $data['status']      = !empty($input['status']) ? 1 : 0;
            $data['name']        = $input['name'];
            $data['type']        = $input['type'];
            $data['description'] = $input['description'];
            $data['views']       = $input['views'] ?? 0;

            Work_videos_model::create($data);
            return redirect('admin/work_videos')->with('success', 'Work video added successfully');
        }
        return view('admin.work_videos.index', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $video_row = Work_videos_model::find($id);
        $input     = $request->all();
        if ($input) {
            if ($request->hasFile('video')) {
                $request->validate([
                    'video' => 'mimes:mp4,mov,avi,wmv,webm|max:500000'
                ]);
                $video = $request->file('video')->store('public/work_videos/');
                if (!empty($video)) {
                    removeImage('work_videos/' . $video_row->video);
                    $video_row->video = basename($video);
                }
            }
            $video_row->status      = !empty($input['status']) ? 1 : 0;
            $video_row->name        = $input['name'];
            $video_row->type        = $input['type'];
            $video_row->description = $input['description'];
            $video_row->views       = $input['views'] ?? 0;
            $video_row->update();
            return redirect('admin/work_videos')->with('success', 'Work video updated successfully');
        }
        $this->data['row'] = Work_videos_model::find($id);
        return view('admin.work_videos.index', $this->data);
    }

    public function delete($id)
    {
        $video_row = Work_videos_model::find($id);
        if (!empty($video_row->video)) {
            removeImage('work_videos/' . $video_row->video);
        }
        $video_row->delete();
        return redirect('admin/work_videos')->with('error', 'Work video deleted successfully');
    }
}
