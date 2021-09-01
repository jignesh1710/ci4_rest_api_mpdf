<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use \Mpdf\Mpdf;
class Api extends ResourceController
{
    use ResponseTrait;
	public function index()
	{	
        $db = \Config\Database::connect();
		$model=new UserModel();
        $data['student']=$model->findAll();
        return $this->respond($data);
	}
    public function insert()
	{	
        return view("insert");
	}
    public function create()
	{
         $fname=$this->request->getvar("fname");
		$lname=$this->request->getvar("lname");
		$email=$this->request->getvar("email");
		$pno=$this->request->getvar("pno");
		$data=array(
			'fname'=>$fname,
			'lname'=>$lname,
			'email'=>$email,
			'pno'=>$pno,
		);
		$model=new UserModel();
		$model->insert($data);
        $response = [
            'status'   => "resource_not_found",
            'data'    => $data,
            'messages' => [
                'success' => 'Employee created successfully'
            ]
        ];
        return $this->respondCreated($response);	
		
	}
    public function mpdf()
	{
		

$mpdf = new \Mpdf\Mpdf();
$html = view('mpdf',[]);
$mpdf->SetHeader('Document Title');
$mpdf->SetFooter('Document Title');
$mpdf->WriteHTML($html);
return redirect()->to($mpdf->Output());
	}
}
