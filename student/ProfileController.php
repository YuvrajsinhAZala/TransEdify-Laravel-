<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('student.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = 'user_' . $user->id . '_' . time() . '.' . $extension;
            $path = 'uploads/avatars/' . $filename;
            
            // Create directory if it doesn't exist
            Storage::disk('public')->makeDirectory('uploads/avatars');
            
            // Resize and save image using GD library (if available)
            $imagePath = $file->getRealPath();
            $imageInfo = function_exists('getimagesize') ? getimagesize($imagePath) : false;
            
            if ($imageInfo !== false && function_exists('imagecreatefromjpeg')) {
                $width = $imageInfo[0];
                $height = $imageInfo[1];
                $mimeType = $imageInfo['mime'];
                
                // Create image resource based on mime type
                switch ($mimeType) {
                    case 'image/jpeg':
                        $sourceImage = imagecreatefromjpeg($imagePath);
                        break;
                    case 'image/png':
                        $sourceImage = imagecreatefrompng($imagePath);
                        break;
                    case 'image/webp':
                        $sourceImage = imagecreatefromwebp($imagePath);
                        break;
                    default:
                        $sourceImage = imagecreatefromjpeg($imagePath);
                }
                
                // Create a square thumbnail (256x256)
                $thumbSize = 256;
                $thumbImage = imagecreatetruecolor($thumbSize, $thumbSize);
                
                // Preserve transparency for PNG
                if ($mimeType === 'image/png') {
                    imagealphablending($thumbImage, false);
                    imagesavealpha($thumbImage, true);
                    $transparent = imagecolorallocatealpha($thumbImage, 0, 0, 0, 127);
                    imagefill($thumbImage, 0, 0, $transparent);
                }
                
                // Calculate crop dimensions to create square image
                $minDimension = min($width, $height);
                $cropX = ($width - $minDimension) / 2;
                $cropY = ($height - $minDimension) / 2;
                
                // Resize and crop to square
                imagecopyresampled(
                    $thumbImage, $sourceImage,
                    0, 0, $cropX, $cropY,
                    $thumbSize, $thumbSize, $minDimension, $minDimension
                );
                
                // Save the thumbnail
                $thumbPath = storage_path('app/public/' . $path);
                imagejpeg($thumbImage, $thumbPath, 90);
                
                // Free memory
                imagedestroy($sourceImage);
                imagedestroy($thumbImage);
            } else {
                // Fallback: just store the file as-is
                $file->storeAs('uploads/avatars', $filename, 'public');
            }
            
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('student.profile.index')->with('success', 'Profile updated successfully!');
    }
}

