<?php

namespace App\Http\Controllers;

use App\Models\drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required",
            "quantity" => "required",
            "image_path" => "image|mimes:jpeg,png,jpg|max:2048"

        ]);

        if ($request->hasFile("image_path")) {
            $filename = $request->file("image_path")->store("turfs", "public");
        } else {
            $filename = null;
        }
        $drug = drug::create([

            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "image_path" => $filename


        ]);

        return response()->json($drug);
    }

    public function readAlldrug()
    {
        $drug = drug::all();
        if (!$drug) {
            return response()->json("No Turf Was found");
        } else {
            return response()->json($drug);
        }
    }

    public function readdrug($id)
    {
        try {
            $drug = drug::findOrFail($id);

            if ($drug) {
                return response()->json($drug);
            } else {
                return response()->json("No Turf Was Found With The ID: ", $id);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Turf Does Not Exist With Such An ID'
            ], 400);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                "name" => "required",

                "description" => "required",
                "price" => "required",
                "quantity" => "required",
                "image_path" => "image|mimes:jpeg,png,jpg|max:2048"

            ]);

            if ($request->hasFile("image_path")) {
                $filename = $request->file("image_path")->store("turfs", "public");
            } else {
                $filename = null;
            }
            $drug = drug::findOrFail($id);

            if ($drug) {
                $drug->name = $request->turf_name;
                $drug->image_path = $filename;

                $drug->description = $request->description;

                $drug->price = $request->price;
                $drug->quantity = $request->quantity;
                $drug->save();

                return response()->json($drug);
            } else {
                return response()->json("No Turf Was Found With The ID: ", $id);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to Update Record!'
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $drug = drug::findOrFail($id);

            if ($drug) {
                drug::destroy($id);
                return response()->json("Record Has Been Successfully Deleted");
            } else {
                return response()->json("Record Does Not Exist With The ID:", $id);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Record Not Deleted!'
            ], 400);
        }
    }
}
