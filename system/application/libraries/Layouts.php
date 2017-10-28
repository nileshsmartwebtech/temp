<?php

class Layouts
{
	private $CI;
	
	private $title_for_layout = NULL;
	
	private $title_separator = ' | ';
	
	private $includes = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function set_title($title)
	{
		$this->title_for_layout = $title;
	}
	
	public function view($view_name, $params = array(), $layout = 'default')
	{
		$rendered_view = $this->CI->load->view($view_name, $params, TRUE);
		
		if ($this->title_for_layout !== NULL)
		{
			$this->title_for_layout = $this->title_separator . $this->title_for_layout;
		}
		
		$this->CI->load->view('layouts/' . $layout, array(
			'content_for_layout' => $rendered_view,
			'title_for_layout' => $this->title_for_layout
		));
	}
	
	public function add_include($path, $prepend_base_url = TRUE)
	{
		if ($prepend_base_url)
		{
			$this->CI->load->helper('url'); // Just in case!
			$this->includes[] = base_url() . $path;
		}
		else
		{
			$this->includes[] = $path;
		}
		
		return $this; // $this->layouts->add_include('blabla')->add_include('blablabla');
	}
	
	public function print_includes()
	{
		$final_includes = '';
		
		foreach ($this->includes as $include)
		{
			if (preg_match('/js$/', $include))
			{
				$final_includes .= '<script src="' . $include . '"></script>';
			}
			elseif (preg_match('/css$/', $include))
			{
				$final_includes .= '<link rel="stylesheet" href="' . $include . '" />';
			}
		}
		
		return $final_includes;
	}
}