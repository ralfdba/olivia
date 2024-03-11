<?php
/**
 * S3 bucket for AWS
 * @author ralf
 */
ini_set('memory_limit', '-1');
require 'vendor/autoload.php';
use Aws\S3\S3Client;
class S3 {
    
    //
    protected function auth_s3() {
        //user AWS
        $response = array(
            "AWS_ACCESS_KEY_ID" => "AAAAAAAAAAAAAAAAAA",
            "AWS_ACCESS_KEY_SECRET" => "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA",
            "AWS_ACCESS_REGION" => "us-east-1",
            "AWS_BUCKET_NAME" => "NAMEBUCKET"
        );

        return $response;

    }
    //
    public function upload( $params ) {
        $objAwsS3Client = new S3Client([
            'version' => 'latest',        
            'region' => $this->auth_s3()['AWS_ACCESS_REGION'],        
            'credentials' => [        
                'key'    => $this->auth_s3()['AWS_ACCESS_KEY_ID'],        
                'secret' => $this->auth_s3()['AWS_ACCESS_KEY_SECRET']
            ]
        ]);
        
        try {
            $objAwsS3Client->putObject([
                'Bucket' => $this->auth_s3()['AWS_BUCKET_NAME'],
                'Key'    => strtolower( $params['file']['name'] ),
                'Body'   => fopen( $_FILES['file']['tmp_name'],'r' ),
                //'ACL'    => 'public-read'
            ]);            
            $response =  "OK";
        } catch ( Aws\S3\Exception\S3Exception $e ) {
            $response =  $e;
        }
        return $response;
    }

    public function list(){

        $objAwsS3Client = new S3Client([
            'version' => 'latest',
            'region' => $this->auth_s3()['AWS_ACCESS_REGION'],
            'credentials' => [        
                'key'    => $this->auth_s3()['AWS_ACCESS_KEY_ID'],        
                'secret' => $this->auth_s3()['AWS_ACCESS_KEY_SECRET']
            ]        
        ]);
        
        try {        
            $objects = $objAwsS3Client->listObjects( [ 'Bucket' => $this->auth_s3()['AWS_BUCKET_NAME'] ] );
            if ( isset( $objects['Contents'] ) ) {
                foreach ($objects['Contents'] as $object) {        
                    $response[] = $object['Key'];
                }
            } else {
                $response = "NOK";
            }       
        } catch (Aws\S3\Exception\S3Exception $e) {        
            $response = $e->getMessage();        
        }
        return $response;
    }


}
?>
