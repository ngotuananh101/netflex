<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use JetBrains\PhpStorm\NoReturn;

class ProfileController extends Controller
{
    /**
     * Display a listing of the profile of user.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $profile = auth()->user()->profile;
            return response()->json([
                'success' => true,
                'data' => $profile,
                'images' => $this->getProfileImages(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get profile of user',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'avatar' => 'required|string|ends_with:.jpg,.jpeg,.png|max:250',
            'is_kid' => 'required|boolean',
        ]);
        try {
            $user = auth()->user();
            // count profile of user
            $countProfile = $user->profile()->count();
            if ($countProfile >= 5) {
                return response()->json([
                    'success' => false,
                    'message' => __('custom.profile.limit'),
                ], 500);
            } else {
               $user->profile()->create([
                    'name' => $request->name,
                    'avatar' => $request->avatar,
                    'is_kid' => $request->is_kid,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => __('custom.profile.create_ok'),
                    'data' => $user->profile,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('custom.profile.create_error'),
                'log' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get profile images list in storage.
     */
    public function getProfileImages(): array
    {
        try {
            // get default profile images list ( in resources/images/profile )
            $path = storage_path('app/public/images/avatars');
            $files = File::allFiles($path);
            $profileImages = [];
            foreach ($files as $file) {
                if($file->getRelativePathname() !== 'add-profile.png'){
                    $profileImages[] = $file->getRelativePathname();
                }
            }
            return $profileImages;
        } catch (\Exception $e) {
            return [];
        }
    }
}
