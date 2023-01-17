<?php
class Products extends Controller
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('product');
        
    }

    public function showProduct()
    {
        $products = $this->productModel->getProducts();
        $data = [
            'products' => $products,
        ];
        $this->view('products/showProduct',$data);
    }
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'nom_produit' => trim($_POST['nom_produit']),
                'prix_produit' => trim($_POST['prix_produit']),
                'description' => trim($_POST['description']),
                'img_produit' =>'',
                'nom_produit_err' => '',
                'prix_produit_err' => '',
                'description_err' => '',
                'img_produit_err'=>'',
            ];
            if(empty($data['nom_produit'])){
                $data['nom_produit_err'] = "s'il vous plait entrer le nom de produit";
            }
           
            if(empty($data['prix_produit'])){
                $data['prix_produit_err'] = "s'il vous plait entrer le prix de produit";
            }
            if(empty($data['img_produit'])){
                $data['img_produit_err'] = "s'il vous plait entrer l'image de produit";
            }
            if(empty($data['description'])){
                $data['description_err'] = "s'il vous plait entrer la description de produit";
            }

            if(empty($data['nom_produit_err']) && empty($data['prix_produit_err']) && empty($data['description_err'])){
                if($this->productModel->addproduct($data)){
                    // die('in IF PRODUCT MODEL');
                    redirect('products/showProduct');
                }else{
                    die('something went wrong');
                }
            }else{
                $this->view('products/addProduct', $data);
            }
        } else {
            $data = [
                'nom_produit' => '',
                'prix_produit' => '',
                'description' => '',
                'img_produit' =>'',
                'nom_produit_err' => '',
                'prix_produit_err' => '',
                'description_err' => '',
                'img_produit_err' =>''
            ];
            $this->view('products/addProduct', $data);
        }
    }
}
