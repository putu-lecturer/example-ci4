<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Config\Services;

class Product extends BaseController
{
    public function index()
    {
        helper('form');
        $productModel = new ProductModel();
        $products = $productModel->findAll();
        return view('home\index', ['data' => $products]);
    }


    public function edit($productCode)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($productCode);
        $data = array('data' => $product);

        if ($this->request->getPost()) {
            $validation = Services::validation();
            $validation->setRules([
                'productCode' => 'required',
                'productName' => 'required',
                'quantityInStock' => 'required|greater_than[0]',
                'buyPrice' => 'required|greater_than[0]',
            ]);

            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $productModel->update($productCode, [
                    'productName' => $this->request->getPost('productName'),
                    'quantityInStock' => $this->request->getPost('quantityInStock'),
                    'buyPrice' => $this->request->getPost('buyPrice')
                ]);

                return redirect('product');
            } else {
                $data['validation'] = $validation;
                $newProduct = array(
                    'productCode' => $productCode,
                    'productName' => $this->request->getPost('productName'),
                    'quantityInStock' => $this->request->getPost('quantityInStock'),
                    'buyPrice' => $this->request->getPost('buyPrice')
                );
                $data['data'] = $newProduct;
            }
        }

        helper('form');
        return view('home\edit', $data);
        // echo json_encode($product);
    }

    private function sendEmail($to, $title, $message)
    {
        $email = Services::email();

        $email->setFrom('system@mail.com', 'System CI');
        $email->setTo($to);
        $email->setMessage($message);
        $email->setSubject($title);
        $email->send();
    }

    public function create()
    {
        $data = array();

        if ($this->request->getPost()) {
            $validation = Services::validation();
            $validation->setRules([
                'productCode' => 'required',
                'productName' => 'required',
                'quantityInStock' => 'required|greater_than[0]',
                'buyPrice' => 'required|greater_than[0]',
                'image' => 'uploaded[image]|max_size[image,1024]|ext_in[image,png,jpg,jpeg,gif]'
            ]);

            $isDataValid = $validation->withRequest($this->request)->run();

            if ($isDataValid) {
                $file = $this->request->getFile('image');
                $file->move(WRITEPATH.'uploads');

                $productModel = new ProductModel();
                $productModel->insert([
                    'productCode' =>  $this->request->getPost('productCode'),
                    'productName' => $this->request->getPost('productName'),
                    'quantityInStock' => $this->request->getPost('quantityInStock'),
                    'buyPrice' => $this->request->getPost('buyPrice'),
                    'imageUrl' => $file->getName()
                ]);

                $this->sendEmail('putu.yogiswara@lecturer.umn.ac.id', 'System Message', 'Insert Success');

                return redirect('product');
            } else {
                $data['validation'] = $validation;
                $newProduct = array(
                    'productCode' => $this->request->getPost('productCode'),
                    'productName' => $this->request->getPost('productName'),
                    'quantityInStock' => $this->request->getPost('quantityInStock'),
                    'buyPrice' => $this->request->getPost('buyPrice')
                );
                $data['data'] = $newProduct;
            }
        }

        helper('form');
        return view('home\create', $data);
    }

  

    public function delete()
    {
        $productCode = $this->request->getPost('productCode');

        $productModel = new ProductModel();
        $productModel->delete($productCode);

        return redirect('product');
    }
}
