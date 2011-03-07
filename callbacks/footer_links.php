<?

global $pages_settings;

$links = array();
foreach($pages_settings['footer_links'] as $page_name)
{
  $links[] = array('href'=>view_page_url($page_name), 'label'=>se($page_name));
}
