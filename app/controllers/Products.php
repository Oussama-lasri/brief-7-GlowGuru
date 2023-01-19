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
        $this->view('products/showProduct', $data);
    }
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // print_r($_POST);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [];
            $key = [];
            // print_r($_POST['nom_produit']);
            foreach ($_POST['nom_produit'] as $key => $value) {
                $key = [
                    'nom_produit' => trim($_POST['nom_produit'][$key]),
                    'prix_produit' => trim($_POST['prix_produit'][$key]),
                    'description' => trim($_POST['description'][$key]),
                    'img_produit' => '',
                    'nom_produit_err' => '',
                    'prix_produit_err' => '',
                    'description_err' => '',
                    'img_produit_err' => '',
                ];

                if (empty($key['nom_produit'])) {
                    $key['nom_produit_err'] = "s'il vous plait entrer le nom de produit";
                }

                if (empty($key['prix_produit'])) {
                    $key['prix_produit_err'] = "s'il vous plait entrer le prix de produit";
                }
                if (empty($key['img_produit'])) {
                    $key['img_produit_err'] = "s'il vous plait entrer l'image de produit";
                }
                if (empty($key['description'])) {
                    $key['description_err'] = "s'il vous plait entrer la description de produit";
                }
                array_push($data, $key);
            }
            print_r($data);

            if (empty($data['nom_produit_err']) && empty($data['prix_produit_err']) && empty($data['description_err'])) {
                $save = $this->productModel->addproduct($data);
                if ($save) {
                    die("success");
                    // redirect('products/showProduct');
                } else {
                    // die("something went wrong")
                    die($save);
                }
            } else {
                $this->view('products/addProduct', $data);
            }
        } else {
            $data = [
                'nom_produit' => '',
                'prix_produit' => '',
                'description' => '',
                'img_produit' => '',
                'nom_produit_err' => '',
                'prix_produit_err' => '',
                'description_err' => '',
                'img_produit_err' => ''
            ];
            $this->view('products/addProduct', $data);
        }
    }

    public function updateProduct($id_produit)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // $data = [];
            // $key = [];
            // print_r($_POST['nom_produit']);
           
                $data = [
                    'id_produit' => $id_produit,
                    'nom_produit' => trim($_POST['nom_produit']),
                    'prix_produit' => trim($_POST['prix_produit']),
                    'description' => trim($_POST['description']),
                    'img_produit' => trim($_FILES['description']),
                    'nom_produit_err' => '',
                    'prix_produit_err' => '',
                    'description_err' => '',
                    'img_produit_err' => '',
                ];
            // die(print_r($data));

                if (empty($data['nom_produit'])) {
                    $data['nom_produit_err'] = "s'il vous plait entrer le nom de produit";
                }

                if (empty($data['prix_produit'])) {
                    $data['prix_produit_err'] = "s'il vous plait entrer le prix de produit";
                }
                if (empty($data['img_produit'])) {
                    $data['img_produit_err'] = "s'il vous plait entrer l'image de produit";
                }
                if (empty($data['description'])) {
                    $data['description_err'] = "s'il vous plait entrer la description de produit";
                }
               
            
            print_r($data);

            if (empty($data['nom_produit_err']) && empty($data['prix_produit_err']) && empty($data['description_err'])) {
                $save = $this->productModel->updateProduct($data);
                if ($save) {
                    die("success");
                    // redirect('products/showProduct');
                } else {
                    // die("something went wrong")
                    die($save);
                }
            } else {
                $this->view('products/updateProduct', $data);
            }
        } else {
            $product = $this->productModel->getProductById($id_produit);
            $data = [
                'id_produit' => $product->id_produit,
                'nom_produit' => $product->nom_produit,
                'prix_produit' => $product->prix,
                'description' => $product->description,
                'img_produit' => ''
            ];
            $this->view('products/updateProduct', $data);
        }
    }

    public function deleteProduct($id_produit){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get existing post from model
            $post = $this->productModel->getProductById($id_produit);
            
            // Check for owner
            // if($post->user_id != $_SESSION['user_id']){
            //   redirect('posts');
            // }
    
            if($this->productModel->deleteProduct($id_produit)){
                die('success');
            } else {
              die('Something went wrong');
            }
          } else {
            redirect('products/showProduct');
          }
            
    }
}
