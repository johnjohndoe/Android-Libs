<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Libraries extends Eloquent implements SluggableInterface {
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

	protected $table = 'libraries';
	public $timestamps = true;


    public function categories()
    {
        return $this->belongsTo('Categories', 'category_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('Like', 'library_id', 'id');
    }

    public function isGitHubUrl()
    {
        return stripos($this->url, 'github.com') == false ? false : true;
    }

    public function getGitHubUserName()
    {
        $sStrippedUrl = str_replace('http://github.com/', '', $this->url);
        $sStrippedUrl = str_replace('https://github.com/', '', $sStrippedUrl);
        return substr($sStrippedUrl, 0, stripos($sStrippedUrl, '/', 1));
    }

    public function getGitHubRepoName()
    {
        $sStrippedUrl = str_replace('http://github.com/', '', $this->url);
        $sStrippedUrl = str_replace('https://github.com/', '', $sStrippedUrl);
        return substr($sStrippedUrl, stripos($sStrippedUrl, '/') + 1, strlen($sStrippedUrl));
    }

    public function getCreatedDate()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getUpdatedDate()
    {
        return date('d/m/Y', strtotime($this->updated_at));
    }

    public function getImages()
    {
        if($this->img == null) {
            return null;
        } else {
            return json_decode($this->img);
        }
    }

    public function getShortenedDescription()
    {
        if(strlen($this->description) > 100)
        {
            // Truncate - cut after last word
            $string = trim($this->description);

            if(strlen($string) > 100) {
                $string = wordwrap($string, 100);
                $string = explode("\n", $string, 2);
                $string = $string[0] . ' ...';
            }
            return $string;
        }
        else
        {
            return $this->description;
        }
    }


}