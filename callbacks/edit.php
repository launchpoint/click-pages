<?

$page_name = p('name');

$role_id = p('role_id');
if(!$role_id)
{
  $r = Role::find_by_name('user');
  $role_id = $r->id;
}
$page = Page::find(array(
  'conditions'=>array('name = ? and role_id = ?', $page_name, $role_id),
  'order'=>'created_at desc'
));

$pages = Page::find_all(array(
  'conditions'=>array('name = ? and role_id = ?', $page_name, $role_id),
  'order'=>'created_at desc'
));

$roles = Role::find_all(array('order'=>'name'));

if ($page==null)
{
  $page = Page::new_model_instance( array(
    'attributes'=>array(
      'name'=>$page_name,
      'role_id'=>$role_id,
      'type'=>'html'
      )
  ));
}

$types = array(
  'markdown'=>'Markdown',
  'html'=>'HTML',
  'text'=>'Text',
  'php'=>'PHP'
);

if (is_postback())
{
  $params['page']['name'] = $page_name;
  $page = Page::create( array(
    'attributes'=>$params['page']
  ));
  if ($page->is_valid)
  {
    flash_next('Text saved.');
  }
}