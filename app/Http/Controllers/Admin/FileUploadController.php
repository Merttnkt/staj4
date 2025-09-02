<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function uploadProductImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            $uploadedFile = $request->file('image');
            $fileName = time() . '_' . Str::random(10) . '.jpg';
            
            $mainPath = 'products/' . $fileName;
            $thumbPath = 'products/thumbs/' . $fileName;
            
            $uploadedFile->storeAs('products', $fileName, 'public');
            
            $this->createThumbnail($uploadedFile->getPathname(), storage_path('app/public/' . $thumbPath), 400, 400);
            
            return response()->json([
                'success' => true,
                'path' => $mainPath,
                'url' => Storage::url($mainPath),
                'thumb_url' => Storage::url($thumbPath),
                'filename' => $fileName
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Resim yükleme hatası: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteProductImage(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        try {
            if (Storage::disk('public')->exists($request->path)) {
                Storage::disk('public')->delete($request->path);
            }

            return response()->json([
                'success' => true,
                'message' => 'Resim başarıyla silindi.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Resim silme hatası: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function createThumbnail($sourcePath, $destPath, $width, $height)
    {
        $destDir = dirname($destPath);
        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }
        
        $imageInfo = getimagesize($sourcePath);
        $mimeType = $imageInfo['mime'];
        
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }
        
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        
        $destImage = imagecreatetruecolor($width, $height);
        
        if ($mimeType == 'image/png') {
            imagealphablending($destImage, false);
            imagesavealpha($destImage, true);
            $transparent = imagecolorallocatealpha($destImage, 255, 255, 255, 127);
            imagefill($destImage, 0, 0, $transparent);
        }
        
        $ratio = max($width / $sourceWidth, $height / $sourceHeight);
        $newWidth = $sourceWidth * $ratio;
        $newHeight = $sourceHeight * $ratio;
        
        $srcX = ($sourceWidth - $newWidth / $ratio) / 2;
        $srcY = ($sourceHeight - $newHeight / $ratio) / 2;
        
        imagecopyresampled(
            $destImage, $sourceImage,
            0, 0, $srcX, $srcY,
            $width, $height, $newWidth / $ratio, $newHeight / $ratio
        );
        
        imagejpeg($destImage, $destPath, 85);
        
        imagedestroy($sourceImage);
        imagedestroy($destImage);
        
        return true;
    }
}