<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Form;
use App\Models\Option;
use App\Models\Payload;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //LIST 1

        $formId = Str::uuid()->toString();
        Form::create([
            'id'=> $formId,
            "name"=> 'Detail Kejadian Risiko Operasional'
        ]);

        $this->listF1_p1($formId);
        $this->listF1_p2($formId);
        $this->listF1_p3($formId);
        $this->listF1_p4($formId);
        $this->listF1_p5($formId);
        $this->listF1_p6($formId);


        $formId = Str::uuid()->toString();
        Form::create([
            'id'=> $formId,
            "name"=> 'Detail Kerugian'
        ]);
        $this->listF2_p1($formId);
        $this->listF2_p2($formId);
        $this->listF2_p3($formId);
        $this->listF2_p4($formId);
        $this->listF2_p5($formId);


        $formId = Str::uuid()->toString();
        Form::create([
            'id'=> $formId,
            "name"=> 'TES ALL COMPONENT'
        ]);
        $this->listF3_p1($formId);
        $this->listF3_p2($formId);
        $this->listF3_p3($formId);
        $this->listF3_p4($formId);
        $this->listF3_p5($formId);
        $this->listF3_p6($formId);
    }




    public function listF1_p1($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

    


        Payload::create([
            "id"=> $payloadId,
            'label' => 'Bulan Pelaporan',
            'parent_id' => $formId, 
            'type' => 'radio_button',
            'answer' => [
                "name"=>"",
                "value"=>[
                    [
                        "id"=> $parentOption,
                        "value" => "",
                        "parent_id" => $payloadId,
                        "label" => "Januari"
                    ]
                ]
            ], 
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih bulan pelaporan',
            'sub_payload_id' => null,
        ]);

  
        Option::insert([
            [
                "id"=> $parentOption,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Januari"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Februari"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Maret"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "April"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Mei"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Juni"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Juli"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Agustus"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "September"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Oktober"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "November"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Desember"
            ]
        ]);
        //LIST 1

    }

    public function listF1_p2($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>[
        //         [
        //             "id"=>$parentOption,
        //             "value" => "",
        //             "parent_id" => $payloadId,
        //             "label" => "Q1"
        //         ],
        //     ]
        // ]);

        Payload::create([
            "id"=> $payloadId,
            'label' => 'Quarter',
            'parent_id' => $formId, 
            'type' => 'radio_button',
            'answer' => [
                "name"=>"",
                "value"=>[
                    [
                        "id"=>$parentOption,
                        "value" => "",
                        "parent_id" => $payloadId,
                        "label" => "Q1"
                    ],
                ]
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih Quarter',
            'sub_payload_id' => null,
        ]);

        Option::insert([
            [
                "id"=> $parentOption,
                'value' => '',
                "parent_id" => $payloadId,
                "label"=> 'Q1'
            ],
            [
                "id"=> Str::uuid()->toString(),
                'value' => '',
                "parent_id" => $payloadId,
                "label"=> 'Q2'
            ],
            [
                "id"=> Str::uuid()->toString(),
                'value' => '',
                "parent_id" => $payloadId,
                "label"=> 'Q3'
            ],
            [
                "id"=> Str::uuid()->toString(),
                'value' => '',
                "parent_id" => $payloadId,
                "label"=> 'Q4'
            ],
        ]);
        //LIST 2
    }

    
    public function listF1_p3($formId){
        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value" => "2019-01-11",
        // ]);

        Payload::create([
            "id"=> $payloadId,
            'label' => 'Tanggal Kejadian',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value" => "2019-01-11",
            ], 
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'sub_type'=> 'date',
            'orm_only' => 'no',
            'description' => 'Isi tanggal kejadian',
            'sub_payload_id' => null,
        ]);
       
    }

    public function listF1_p4($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>"2019-01-11"
        // ]);


        Payload::create([
            "id"=> $payloadId,
            'label' => 'Tanggal Ditemukan',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"2019-01-11"
            ], 
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            "sub_type"=>"date",
            'orm_only' => 'no',
            'description' => 'Isi tanggal ditemukan',
            'sub_payload_id' => null,
        ]);
    }


    public function listF1_p5($formId){

        //LIST 2
        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>"Terdapat selisih angsuran hutang pokok fasilitas pembiayaan a.n PT Mitratel pada sistem arium dibandingkan jadwal pada PK sebesar Rp. 2000 pada 3 periode "
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Deskripsi Kejadian',
            'parent_id' => $formId, 
            'type' => 'long_text',
            'answer' => [
                "name"=>"",
                "value"=>"Terdapat selisih angsuran hutang pokok fasilitas pembiayaan a.n PT Mitratel pada sistem arium dibandingkan jadwal pada PK sebesar Rp. 2000 pada 3 periode "
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Jelaskan dengan detail kronologis kejadian',
            'sub_payload_id' => null,
        ]);
    }
    

    public function listF1_p6($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>"Penjadwalan angsuran menggunakan presentase dari nilai pokok saat pencairan, bukan angka nominal sehingga mengakibatkan nilai angsuran per periode menjadi kelebihan 2rb rupiah"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Deskripsi Penyebab / Root Cause Terjadinya Kejadian',
            'parent_id' => $formId, 
            'type' => 'long_text',
            'answer' => [
                "name"=>"",
                "value"=>"Penjadwalan angsuran menggunakan presentase dari nilai pokok saat pencairan, bukan angka nominal sehingga mengakibatkan nilai angsuran per periode menjadi kelebihan rupiah"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Jelaskan dengan detail root cause kejadian',
            'sub_payload_id' => null,
        ]);

    }
    


    public function listF2_p1($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption1 = Str::uuid()->toString();
        $parentOption2 = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>[
        //         $parentOption1,
        //         $parentOption2
        //     ]
        // ]);


        Payload::create([
            "id"=> $payloadId,
            'label' => 'Terkena Dampak',
            'parent_id' => $formId, 
            'type' => 'checkbox',
            'answer' => [
                "name"=>"",
                "value"=>[
                    $parentOption1,
                    $parentOption2
                ]
            ],
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih divisi yang terkena dampak dari risiko ini',
            'sub_payload_id' => null,
        ]);

  
        Option::insert([
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DSP"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DSDM"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DP2"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPPU1"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPPU2"
            ],
            [
                "id"=> $parentOption1,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DAA"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DTI"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DEPI"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DAI"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DRE"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPB"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPP"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPPU3"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPOP"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPPIK"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPKMI"
            ],
            [
                "id"=> $parentOption2,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DP1"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DUS"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DJK"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DKHI"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DUP"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DMRT"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DELST"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DH"
            ]
        ]);
    }

    public function listF2_p2($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"-"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Kerugian Financial',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"-"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "amount",
            'orm_only' => 'no',
            'description' => 'Besarnya kerugian financial Perseroan',
            'sub_payload_id' => null,
        ]);

    }
    public function listF2_p3($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"6000"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Potensial Kerugian Financial',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"6000"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "amount",
            'orm_only' => 'no',
            'description' => 'Besarnya kerugian finansial yang diperkirakan akan menjadi kerugian Perseroan',
            'sub_payload_id' => null,
        ]);
    }

    public function listF2_p4($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"Recovery"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Status',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"Recovery"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "text",
            'orm_only' => 'no',
            'description' =>  "Isi status detail kerugian",
            'sub_payload_id' => null,
        ]);

    }

    public function listF2_p5($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"Perbedaan angsuran hutang pokok antara perjanjian pembiayaan dengan sistem arium, pencatatan outstanding fasilitas pembiayaan menjadi tidak sesuai dengan perjanjian pembiayaan."
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Kerugian Non-Financial',
            'parent_id' => $formId, 
            'type' => 'long_text',
            'answer' => [
                "name"=>"",
                "value"=>"Perbedaan angsuran hutang pokok antara perjanjian pembiayaan dengan sistem arium, pencatatan outstanding fasilitas pembiayaan menjadi tidak sesuai dengan perjanjian pembiayaan."
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "text",
            'orm_only' => 'no',
            'description' =>  "Kejadian risiko operasional yang terjadi pada Perseroan, menimbulkan exposure risiko non finansial misalnya : kesalahan pelaporan kepada Regulator atau risiko reputasi",
            'sub_payload_id' => null,
        ]);

    }
    







    public function listF3_p1($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();



        Payload::create([
            "id"=> $payloadId,
            'label' => 'Bulan Pelaporan',
            'parent_id' => $formId, 
            'type' => 'radio_button',
            'answer' => [
                "name"=>"",
                "value"=>[
                    [
                        "id"=> $parentOption,
                        "value" => "",
                        "parent_id" => $payloadId,
                        "label" => "Februari"
                    ]
                ]
            ], 
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih bulan pelaporan',
            'sub_payload_id' => null,
        ]);

  
        Option::insert([
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Januari"
            ],
            [
                "id"=> $parentOption,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Februari"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "Maret"
            ],
           
        ]);
        //LIST 1

    }

    public function listF3_p2($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption1 = Str::uuid()->toString();
        $parentOption2 = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value"=>[
        //         $parentOption1,
        //         $parentOption2
        //     ]
        // ]);


        Payload::create([
            "id"=> $payloadId,
            'label' => 'Terkena Dampak',
            'parent_id' => $formId, 
            'type' => 'checkbox',
            'answer' => [
                "name"=>"",
                "value"=>[
                    $parentOption1,
                    $parentOption2
                ]
            ],
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih divisi yang terkena dampak dari risiko ini',
            'sub_payload_id' => null,
        ]);

  
        Option::insert([
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DSP"
            ],
            [
                "id"=> $parentOption1,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DSDM"
            ],
            [
                "id"=> $parentOption2,
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DP2"
            ],
            [
                "id"=> Str::uuid()->toString(),
                "value" => "",
                "parent_id" => $payloadId,
                "label" => "DPPU1"
            ],
        ]);
    }
  
    public function listF3_p3($formId){
        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     "id"=>$answerId,
        //     "name"=>"",
        //     "value" => "2019-01-11",
        // ]);

        Payload::create([
            "id"=> $payloadId,
            'label' => 'Tanggal Kejadian',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value" => "2019-01-11",
            ], 
            'support_file' => [
                 'value' => '',
                 'name' => ''
            ],
            'sub_type'=> 'date',
            'orm_only' => 'no',
            'description' => 'Isi tanggal kejadian',
            'sub_payload_id' => null,
        ]);
       
    }
    public function listF3_p4($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"6000"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Potensial Kerugian Financial',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"6000"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "amount",
            'orm_only' => 'no',
            'description' => 'Besarnya kerugian finansial yang diperkirakan akan menjadi kerugian Perseroan',
            'sub_payload_id' => null,
        ]);
    }

    public function listF3_p5($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"Recovery"
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Status',
            'parent_id' => $formId, 
            'type' => 'text',
            'answer' => [
                "name"=>"",
                "value"=>"Recovery"
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "text",
            'orm_only' => 'no',
            'description' =>  "Isi status detail kerugian",
            'sub_payload_id' => null,
        ]);

    }

    public function listF3_p6($formId){

        $payloadId = Str::uuid()->toString();
        $answerId = Str::uuid()->toString();
        $parentOption = Str::uuid()->toString();

        // Answer::create([
        //     'id' => $answerId, 
        //     "name"=>"",
        //     "value"=>"Perbedaan angsuran hutang pokok antara perjanjian pembiayaan dengan sistem arium, pencatatan outstanding fasilitas pembiayaan menjadi tidak sesuai dengan perjanjian pembiayaan."
        // ]);

        
        Payload::create([
            "id"=> $payloadId,
            'label' => 'Kerugian Non-Financial',
            'parent_id' => $formId, 
            'type' => 'long_text',
            'answer' => [
                "name"=>"",
                "value"=>"Perbedaan angsuran hutang pokok antara perjanjian pembiayaan dengan sistem arium, pencatatan outstanding fasilitas pembiayaan menjadi tidak sesuai dengan perjanjian pembiayaan."
            ], 
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            "sub_type"=> "text",
            'orm_only' => 'no',
            'description' =>  "Kejadian risiko operasional yang terjadi pada Perseroan, menimbulkan exposure risiko non finansial misalnya : kesalahan pelaporan kepada Regulator atau risiko reputasi",
            'sub_payload_id' => null,
        ]);

    }

}
