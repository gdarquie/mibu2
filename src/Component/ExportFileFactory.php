<?php


namespace App\Component;


class ExportFileFactory
{
    public static function create($format, $fragments)
    {
        switch ($format) {
            case 'txt':
                self::createTxt($fragments);
                break;
            case 'json':
                self::createJson($fragments);
                break;
            default:
                throw new \Exception ('Unknown text format!');
        }
    }

    /**
     * @param $fragments
     */
    public static function createTxt($fragments)
    {
        $fragmentsText = '';
        foreach ($fragments as $key => $fragment) {
            $fragmentsText .= "\nFragment ".$key." : ".$fragment->getContent()."\n--------";
        }

        self::createFile('txt', $fragmentsText);
    }

    /**
     * @param $fragments
     */
    public static function createJson($fragments)
    {
        $fragmentsList = [];
        foreach ($fragments as $key => $fragment) {
            $fragmentsList[] = $fragment->getContent();
        }

        $fragmentsList = json_encode($fragmentsList);

        self::createFile('json', $fragmentsList);
    }

    /**
     * @param $format
     * @param $data
     */
    private static function createFile($format, $data)
    {
        $id = uniqid();
        $file = 'export_'.$id.'.'.$format;
        $handle = fopen($file, 'w') or die('Cannot open file:  '.$file);
        fwrite($handle, $data);
    }
}