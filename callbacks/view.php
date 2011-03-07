<?

$args = array(
  'page_name'=>p('name'),
);

if(p('role_name'))
{
  $args['role_name'] = p('role_name');
}

event('render_page', $args);