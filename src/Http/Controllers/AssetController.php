<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\Response;

class AssetController extends Controller
{
    public function __invoke(string $path): Response
    {
        if (! file_exists($path) || $path === false) {
            $data = $path;
            $timestamp = \DateTime::createFromFormat('U', now()->format('U'));
        } else {
            $data = file_get_contents($path);
            $timestamp = \DateTime::createFromFormat('U', (string) filemtime($path));
        }

        return response($data, 200, [ 'Content-Type' => 'application/javascript' ])
            ->setLastModified($timestamp);
    }
}
