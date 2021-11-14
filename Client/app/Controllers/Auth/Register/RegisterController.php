<?php

namespace App\Controllers\Auth\Register;

use App\Controllers\BaseController;
use App\Models\Client;

class RegisterController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        if (!$this->validate([
            'email_client' => [
                'rules' => 'required|valid_email|max_length[50]|is_unique[tbl_client.email_client]',
                'errors' => [
                    'required' => 'Email Harus diisi',
                    'valid_email' => 'Email tidak sesuai format',
                    'max_length' => 'Email Maksimal 20 Karakter',
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
            'password_client' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => 'Password Harus diisi',
                    'min_length' => 'Password Minimal 4 Karakter',
                    'max_length' => 'Password Maksimal 50 Karakter',
                ]
            ],
            'password_confirm' => [
                'rules' => 'matches[password_client]',
                'errors' => [
                    'matches' => 'Password Confirm tidak sesuai dengan password',
                ]
            ],
            'telp_client' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phone Number harus diisi',
                    'numeric' => 'Phone Number harus angka',
                ]
            ],
            'alamat_client' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'matches' => '{field} harus diisi',
                    'min_length' => '{field} Minimal 3 Karakter',
                ]
            ],
            'nama_client' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Nama Harus diisi',
                    'min_length' => 'Nama minimal 3 Karakter',
                    'max_length' => 'Nama maksimal 100 Karakter',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $client = new Client();
        $client->save([
            'nama_client'	=> $this->request->getVar('nama_client'),
            'email_client' 	=> $this->request->getVar('email_client'),
            'password_client'	=> password_hash($this->request->getVar('password_client'), PASSWORD_BCRYPT),
            'telp_client'   =>  $this->request->getVar('telp_client'),
            'alamat_client' => $this->request->getVar('alamat_client'),
            'is_active'	=> 0,
        ]);
        $email_client = $this->request->getVar('email_client');
        $clientId = $client->getInsertID();
        $token = base64_encode(random_bytes(32));
        $client_token = [
                'client_id' => $clientId,
                'token'	=> $token,
                'date_created'	=> time()
            ];
        $db->table('tbl_token')->insert($client_token);
        $this->_sendEmail($token, $email_client);
        session()->setFlashdata('success', 'Registrasi berhasil! Silahkan cek email Anda untuk aktivasi akun');
        return redirect()->to('/signin');
    }
    private function _sendEmail($token, $email_client)
    {
        $email = \Config\Services::email();

        $email->setFrom('info.cvkarina@gmail.com', 'CV Karina Desain');
        $email->setTo($email_client);
        $email->setSubject('Account Activation');
        $email->setMessage('
			<!DOCTYPE html>
			<html>

			<head>
			<title></title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<style type="text/css">
			@media screen {
				@font-face {
					font-family: "Lato";
					font-style: normal;
					font-weight: 400;
					src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
				}

				@font-face {
					font-family: "Lato";
					font-style: normal;
					font-weight: 700;
					src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
				}

				@font-face {
					font-family: "Lato";
					font-style: italic;
					font-weight: 400;
					src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
				}

				@font-face {
					font-family: "Lato";
					font-style: italic;
					font-weight: 700;
					src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
				}
			}
			body,
			table,
			td,
			a {
				-webkit-text-size-adjust: 100%;
				-ms-text-size-adjust: 100%;
			}

			table,
			td {
				mso-table-lspace: 0pt;
				mso-table-rspace: 0pt;
			}

			img {
				-ms-interpolation-mode: bicubic;
			}
			img {
				border: 0;
				height: auto;
				line-height: 100%;
				outline: none;
				text-decoration: none;
			}

			table {
				border-collapse: collapse !important;
			}

			body {
				height: 100% !important;
				margin: 0 !important;
				padding: 0 !important;
				width: 100% !important;
			}
			a[x-apple-data-detectors] {
				color: inherit !important;
				text-decoration: none !important;
				font-size: inherit !important;
				font-family: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
			}

			/* MOBILE STYLES */
			@media screen and (max-width:600px) {
				h1 {
					font-size: 32px !important;
					line-height: 32px !important;
				}
			}

			/* ANDROID CENTER FIX */
			div[style*="margin: 16px 0;"] {
				margin: 0 !important;
			}
			</style>
			</head>

			<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<!-- LOGO -->
			<tr>
			<td bgcolor="#3CBEB2" align="center">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
			<tr>
			<td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td bgcolor="#3CBEB2" align="center" style="padding: 0px 10px 0px 10px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
			<tr>
			<td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
			<h1 style="font-size: 48px; font-weight: 400; margin: 2;">Account Activation!</h1> <img src="'.base_url().'images/logokj/logokj11.png'.'" width="125" height="120" style="display: block; border: 0px;" />
			</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
			<tr>
			<td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
			<p style="margin: 0;">Anda harus mengaktifkan akun anda untuk melanjutkan login. <br><br>Jika Anda tidak mengaktifkan akun terlebih dahulu, maka Anda tidak dapat masuk menggunakan akun. Silakan klik tombol "Activate" di bawah ini.</p>
			</td>
			</tr>
			<tr>
			<td bgcolor="#ffffff" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
			<table border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td align="center" style="border-radius: 3px;" bgcolor="#3CBEB2"><a href="'.base_url().'/signup/activation?email=' . $email_client . '&token=' . urlencode($token) .'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #3cbeb2; display: inline-block;">Activate</a></td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr> <!-- COPY -->
			<tr>
			<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
			<p style="margin: 0;">Jika ada pertanyaan, silahkan balas email ini. Kami sangat senang membantu Anda.</p>
			</td>
			</tr>
			<tr>
			<td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
			<p style="margin: 0;">Salam,<br>CV. Karina</p>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table>
			</body>

			</html>');
        if ($email->send()) {
            return true;
        } else {
            echo $email->printDebugger();
            die();
        }
    }
    public function activation()
    {
        $db = \Config\Database::connect();
        $tbl_client = $db->table('tbl_client');
        $tbl_token = $db->table('tbl_token');
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $client = $tbl_client->getWhere(['email_client' => $email])->getRowArray();
        $clientId = $client['id_client'];
        if ($client) {
            $client_token = $tbl_token->getWhere(['token' => $token])->getRowArray();
            if ($client_token) {
                if (time() - $client_token['date_created'] < (60*60*24)) {
                    $tbl_client->set('is_active', 1);
                    $tbl_client->where('email_client', $email);
                    $tbl_client->update();
                    $tbl_token->where('client_id', $clientId);
                    $tbl_token->delete();
                    session()->setFlashdata('success', 'Selamat! <b>'.$email.'</b> telah aktif, sekarang Anda sudah bisa untuk masuk');
                    return redirect()->to('/signin');
                } else {
                    $tbl_client->where('email_client', $email);
                    $tbl_client->delete();
                    $tbl_token->where('client_id', $clientId);
                    $tbl_token->delete();
                    $this->session->set_flashdata('error', 'Account activation failed! Token expired, please re-register');
                    return redirect()->to('/signin');
                }
            } else {
                session()->setFlashdata('error', 'Account activation failed! Wrong token');
                return redirect()->to('/signin');
            }
        } else {
            session()->setFlashdata('error', 'Account activation failed! Wrong email');
            redirect()->to('/signin');
        }
    }
}
