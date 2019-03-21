<?php
require 'vendor/autoload.php';

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

$client = new SqsClient([
    'profile' => 'default',
    'region' => 'us-east-1',
    'version' => '2012-11-05'
]);

$params = [
    'MessageAttributes' => [
        "Title" => [
            'DataType' => "String",
            'StringValue' => "The Hitchhiker's Guide to the Galaxy"
        ],
        "Author" => [
            'DataType' => "String",
            'StringValue' => "Douglas Adams."
        ],
        "WeeksOn" => [
            'DataType' => "Number",
            'StringValue' => "6"
        ]
    ],
    'MessageDeduplicationId'=>'messagededuplicationid1006', // これがないとエラーになるらしい
    'MessageGroupId'=>'messagegroupid1000', // これがないとエラーになるらしい
    'MessageBody' => "Information about current NY Times fiction bestseller for week of 12/11/2016.",
    'QueueUrl' => 'https://sqs.us-east-1.***************/sample.fifo'
];

try {
    $result = $client->sendMessage($params);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
}

