<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Product extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->model = new \App\Models\ProductModel();

        
    }

    public function index()
    {
        $dataProduct = $this->model->findAll();

        return view('product/index' , ['products' => $dataProduct]);
    }

    public function 

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('product/new');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/product');
        }
        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]'
        ]);
        if ($validation == false)
        {
            $this->session->setFlashdata('error', 'Invalid file format. Please upload a valid image (jpg, jpeg, gif, png).');
            return redirect()->to('/product');
        }
        else
        {
            date_default_timezone_set('Asia/Jakarta');
            $upload = $this->request->getFile('file_upload');
            $upload->move(ROOTPATH . 'public/upload/');
            $data = array(
                'name' => $this->request->getPost('name'),
                'img' => $upload->getName(),
                'price' => $this->request->getPost('price'),
                'stock' => $this->request->getPost('stock'),
                'created_at' => date('Y-m-d H:i:s'),
            );
            $this->model->save_img($data);
            return redirect()->to('/product');
        }
        
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $dataProduct = $this->model->where('id',$id)->first();

        return view('product/edit' , ['product' => $dataProduct]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $productData = $this->model->where('id',$id)->first();
        if (!$productData) {
            // Handle case where the product does not exist
            return redirect()->to('/product');
        }
        
        if ($this->request->getPost() != null) {
            date_default_timezone_set('Asia/Jakarta');
            $data = [
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock' => $this->request->getPost('stock'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
    
            // Check if a new file was uploaded
            if ($this->request->getFile('file_upload')->isValid()) {
                // Delete the old image if it exists
                if (!empty($productData['img'])) {
                    unlink(ROOTPATH . 'public/upload/' . $productData['img']);
                }
    
                // Handle file upload and update the 'img' column in your database
                $upload = $this->request->getFile('file_upload');
                $upload->move(ROOTPATH . 'public/upload/');
                $data['img'] = $upload->getName();
            }
    
            // Update the data in your database
            $this->model->update_img($id, $data);
            
            return redirect()->to('/product');
        }
        else
        {
            return redirect()->to('/product');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $productData = $this->model->where('id',$id)->first();

        if ($productData) {
            // Delete the image file from the server
            unlink(ROOTPATH . 'public/upload/' . $productData['img']);
    
            // Delete the product data from the database
            $this->model->delete($id);
        }

        return redirect()->to('/product');
    }
}
