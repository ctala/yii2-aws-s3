# Yii2 AWS S3

An Amazon S3Client wrapper as Yii2 component.

Yii2 AWS S3 can only work with **one** bucket per a component configuration.

The component currently supports CloudFront (getting a CDN url for an object in a S3 bucket).

## Installation
1. Run the [Composer](http://getcomposer.org/download/) command to install the latest stable version:
    ```
    composer require ctala/yii2-aws-s3
    ```

2. Add component to `config/main.php`

    ```php
    'components' => [
        // ...
        's3bucket' => [
            'class' => \CTala\Storage::className(),
            'region' => 'your region',
            'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                'key' => 'your aws s3 key',
                'secret' => 'your aws s3 secret',
            ],
            'bucket' => 'your aws s3 bucket',
            'cdnHostname' => 'http://example.cloudfront.net',
            'defaultAcl' => \CTala\Storage::ACL_PUBLIC_READ,
            'debug' => true, // bool|array
        ],
        // ...
    ],
    ```

## Usage

### Uploading objects
```php
// creating an object
$data = ['one', 'two', 'three'];
Yii::$app->get('s3bucket')->put('path/to/s3object.ext', Json::encode($data));

// uploading an object by streaming the contents of a stream
$resource = fopen('/path/to/local/file.ext', 'r+');
Yii::$app->get('s3bucket')->put('path/to/s3object.ext', $resource);
```

### Uploading files
```php
Yii::$app->get('s3bucket')->upload('path/to/s3object.ext', '/path/to/local/file.ext');
```

### Uploading large files using multipart uploads with custom options
```php
$concurrency = 5;
$minPartSize = 536870912; // 512 MB

Yii::$app->get('s3bucket')->multipartUpload(
    'path/to/s3object.ext',
    '/path/to/local/file.ext',
    $concurrency,
    $minPartSize
);
```

### Reading objects
```php
/** @var \Aws\Result $result */
$result = Yii::$app->get('s3bucket')->get('path/to/s3object.ext');
$data = $result['Body'];
```

### Saving objects to a file
```php
Yii::$app->get('s3bucket')->get('path/to/s3object.ext', '/path/to/local/file.ext');
```

### Deleting objects
```php
Yii::$app->get('s3bucket')->delete('path/to/s3object.ext');
```

### Getting a plain URL
```php
$url = Yii::$app->get('s3bucket')->getUrl('path/to/s3object.ext');
```

### Creating a pre-signed URL
```php
$url = Yii::$app->get('s3bucket')->getPresignedUrl('path/to/s3object.ext', '+10 minutes');
```

### Getting a CDN URL
```php
$url = Yii::$app->get('s3bucket')->getCdnUrl('path/to/s3object.ext');
```

### Listing objects
```php
$result = Yii::$app->get('s3bucket')->getList('path/');
foreach ($result['Contents'] as $object) {
    echo $object['Key'] . PHP_EOL;
}
```

##ChangeLog

* 0.6 : Added Create Folder, Added Iterator for All files.