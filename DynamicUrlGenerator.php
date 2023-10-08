<?php
class DynamicUrlGenerator
{
    private $base_url;

    public function __construct()
    {
        // Adjust the base URL to your root URL
        $this->base_url = 'http://localhost/e-comercee';
    }

    public function generateLink($path)
    {
        // Normalize the provided path by removing any leading slashes
        $path = ltrim($path, '/');

        // Combine the base URL and the normalized path
        $full_url = rtrim($this->base_url, '/') . '/' . $path;

        return $full_url;
    }
}
