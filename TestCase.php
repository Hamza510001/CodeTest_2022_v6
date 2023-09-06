<?php
    
namespace Tests\Controllers;
    
use Illuminate\Http\Response;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Str;
use CODETEST_2022_V6\test\app\Repository\UserRepository; 
use CODETEST_2022_V6\test\app\Helpers\TeHelper; 

class UserControllerTests extends TestCase {


    public function createOrUpdate() {

        $payload = [
                'user_type' =>env('CUSTOMER_ROLE_ID'),
                'name'  => $this->faker->firstName,
                'company_id'      => 15,
                'department_id' => $this->faker->firstName,
                'email'  => $this->faker->email,
                'dob_or_orgid'      => Str::random(10),
                'password'=> Str::random(10),
                'phone' =>  $this->faker->phoneNumber,
                'mobile'      => $this->faker->phoneNumber,
                'new_towns' => "China Town",
                'status'  => 1,
                'consumer_type'  => 'paid',
                'username' => $this->faker->lastName,
                'post_code'  => Str::random(10),
                'address'      => $this->faker->address,
                'city' => Str::random(10),
                'town'  => Str::random(10),
                'country'      => Str::random(10),
        ];

        $userRepository = new UserRepository;
        $respUser = $userRepository->createOrUpdate(null, $payload);
       
        
        if($respUser){
            $this->assertJsonStructure(
                [
                    'id',
                    'user_type',
                    'name',
                    'company_id',
                    'email',
                    'dob_or_orgid',
                    'phone',
                    'mobile'
                       
                ] 
            );
          }
         else{
            $this->assertTrue(false);
          }
    }


    public static function willExpireAt()
    {

        $from = Carbon::parse('2018-01-01')->toDateTimeString();
        $to = Carbon::parse('2018-05-10')
            ->addHours(24)
            ->toDateTimeString();

        $teHelper = new TeHelper;
        $resp = $teHelper->willExpireAt($to,$from);
        $this->assertTrue( Carbon::createFromFormat('Y-m-d H:i:s', $resp) !== false );
     
    }
    
}