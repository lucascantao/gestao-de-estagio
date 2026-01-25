<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileStorageService { 
	private const STORAGE_NAME = "public";

	public function makeDirectory($path): void {
		if (!File::isDirectory($path)) {
			File::makeDirectory($path, 0755, true);
			// dd($path);
		}
	}

	public function storeFile($filename, $fileContent, $subfolder): string {
		$path = Storage::disk(self::STORAGE_NAME)->path($subfolder);
		$this->makeDirectory($path);
		$fullname = $subfolder.'/'.$filename;
		return Storage::disk(self::STORAGE_NAME)->put($fullname, $fileContent);
	}

	public function deleteFile($filename, $subfolder): void {
        $path = Storage::disk(self::STORAGE_NAME)->path($subfolder.$filename);
        File::delete($path);
    }
}