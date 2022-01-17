<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;



class ProductsController extends Controller
{





    /**
         * @OA\Get(
         * path="/api/products",
         * summary="get all producst",
         * description="get all producst",
         * tags={"products"},
         *   @OA\Response(
         *      response=200,
         *       description="Success",
         *      @OA\MediaType(
         *           mediaType="application/json",
         *      )
         *   ),
         *   @OA\Response(
         *      response=201,
         *       description="Created",
         *      @OA\MediaType(
         *           mediaType="application/json",
         *      )
         *   ),
         *   @OA\Response(
         *      response=401,
         *       description="Unauthenticated"
         *   ),
         *   @OA\Response(
         *      response=400,
         *      description="Bad Request"
         *   ),
         *   @OA\Response(
         *      response=404,
         *      description="not found"
         *   ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      )
         *)
         */



    public function index()
    {
        $products = Product::all();
        return response()->json($products,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }



     /** @OA\Post(
     * path="/api/store",
     *   tags={"products"},
     * security={{ "apiAuth": {} }},
     *   summary="store",
     *   operationId="store",
     * @OA\RequestBody(
     *    required=true,
     *    description="store",
     *    @OA\MediaType(
     *      mediaType="multipart/form-data",
     *    @OA\Schema(
     *      required={"name","description","price","image"},
     *       @OA\Property(property="name", type="string", example="user"),
     *       @OA\Property(property="description", type="string", example="aaaaa"),
     *       @OA\Property(property="price", type="number",  example="500"),
     *       @OA\Property(property="image", type="file",  example=""),
     *      )
     *    )
     *  ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Created",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     *
     */




    public function store(Request $request)
    {
        $user = auth("api")->user();

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->user_id = $user->id;
        if ($request->hasFile('image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // FileName to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $product->image = $fileNameToStore;
        $product->save();
        return response()->json($product,201);
    }







    public function show($id)
    {
        // $product = Product::find($id);
        // return response()->json($product,200);
    }

    /**
         * @OA\post(
         * path="/api/edit/{id}",
         * summary="edit product",
         * description="edit product",
         * tags={"products"},
         * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="product_id",
     * ),
         * @OA\RequestBody(
    *    required=true,
    *    description="Add",
    *    @OA\MediaType(
    *      mediaType="multipart/form-data",
    *    @OA\Schema(
    *
    *       @OA\Property(property="name", type="string", example="T_shirt"),
    *       @OA\Property(property="description", type="string", example="Short"),
    *       @OA\Property(property="price", type="string",example="30000"),
     *       @OA\Property(property="image", type="file",example=""),

    *
    *      )
    *    )
    *  ),

         *   @OA\Response(
         *      response=200,
         *       description="Success",
         *      @OA\MediaType(
         *           mediaType="application/json",
         *      )
         *   ),
         *   @OA\Response(
         *      response=201,
         *       description="Created",
         *      @OA\MediaType(
         *           mediaType="application/json",
         *      )
         *   ),
         *   @OA\Response(
         *      response=401,
         *       description="Unauthenticated"
         *   ),
         *   @OA\Response(
         *      response=400,
         *      description="Bad Request"
         *   ),
         *   @OA\Response(
         *      response=404,
         *      description="not found"
         *   ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      )
         *)
         */
        public function edit($id)
        {
            //
            $product=Product::find($id);
            return response()->json(["status"=>"Updated","product"=>$product], 200);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
