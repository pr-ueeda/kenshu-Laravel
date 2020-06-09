<?php

namespace App\functions;

use Illuminate\Support\Facades\Storage;

class SplitRegister {

    public function splitSaveTags(String $request): array {
        // タグをformから取得し、#で区切って代入
        $tags_name = explode('#', $request);
        $tag_ids = [];
        // 区切った分を回しつつ、Tagsテーブルに格納し、格納したidを配列に代入
        foreach ($tags_name as $tag_name) {
            if (!empty($tag_name)) {
                $tag_insert = \App\Models\Tag::firstOrCreate([
                    'tag_name' => $tag_name,
                ]);
                $tag_ids[] = $tag_insert->id;
            }
        }

        return $tag_ids;
    }

    public function splitSaveImages(array $request): array {
        $images_id = [];
        foreach ($request as $image) {
            // public/imagesフォルダへ保存
            $save_path = Storage::disk('sftp')->putFile('public/images', $image);
            // 保存先のパスから参照先のパスへ置換
            $reference_path = str_replace('public', 'storage', $save_path);
            $image_insert = \App\Models\Image::firstOrCreate([
                'image_url' => '/' . $reference_path
            ]);
            $images_id[] = $image_insert->id;
        }

        return $images_id;
    }
}
