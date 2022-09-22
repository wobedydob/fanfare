<?php

namespace Entity;

class Url
{

    //region Attributes
    public string $scheme;
    public string $host;
    public string $path;
    public ?string $query;
    //endregion

    //region Constructor
    public function __construct(string $scheme, string $host, string $path, string $query = null)
    {
        $this->scheme = $scheme;
        $this->host = $host;
        $this->path = $path;
        $this->query = $query;
    }
    //endregion

    //region Methods
    /** Returns the complete url */
    public function getUrl(bool $use_query = false): string
    {
        $url = $this->scheme . '://' . $this->host . $this->path;
        $url .= $use_query ? '?' . $this->query : null;
        return $url;
    }
    //endregion


}