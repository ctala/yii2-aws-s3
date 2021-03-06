<?php

namespace CTala;

/**
 * Interface StorageInterface
 *
 * @package ctala\yii2\aws\s3
 */
interface StorageInterface
{
    /**
     * @param string $filename
     * @param string $saveAs
     *
     * @return \Aws\ResultInterface
     */
    public function get($filename, $saveAs = null);

    /**
     * @param string $filename
     * @param mixed $data
     * @param string $acl
     * @param array $options
     *
     * @return \Aws\ResultInterface
     */
    public function put($filename, $data, $acl = null, array $options = []);

        /**
     * @param string $filename
     * @param mixed $data
     * @param string $acl
     * @param array $options
     *
     * @return \Aws\ResultInterface
     */
    public function putImage($filename, $data, $acl = null, $contentType);
    
    /**
     * @param string $filename
     *
     * @return \Aws\ResultInterface
     */
    public function delete($filename);

    /**
     * @param string $filename
     *
     * @return string
     */
    public function getUrl($filename);

    /**
     * @param string $filename
     * @param string|int|\DateTime $expires
     *
     * @return string
     */
    public function getPresignedUrl($filename, $expires);

    /**
     * @param string $filename
     *
     * @return string
     */
    public function getCdnUrl($filename);

    /**
     * @param string $prefix
     * @param array $options
     *
     * @return \Aws\ResultInterface
     */
    public function getList($prefix = null, array $options = []);

    /**
     * @param string $filename
     * @param mixed $source
     * @param string $acl
     * @param array $options
     *
     * @return \Aws\ResultInterface
     */
    public function upload($filename, $source, $acl = null, array $options = []);

    /**
     * @param string $filename
     * @param mixed $source
     * @param int $concurrency
     * @param int $partSize
     * @param string $acl
     * @param array $options
     *
     * @return \Aws\ResultInterface
     */
    public function multipartUpload(
        $filename,
        $source,
        $concurrency = null,
        $partSize = null,
        $acl = null,
        array $options = []
    );
}
