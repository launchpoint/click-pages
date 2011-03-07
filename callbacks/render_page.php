<?

if(!isset($show_title)) $show_title = true;

$pages=array();
if(!isset($role_name) || !$role_name)
{
  $role_ids = collect($current_user->roles, 'id');
  $role_ids = join(',', $role_ids);
  $pages = Page::find_all(array(
    'conditions'=>array('name = ? and role_id in (!) and id in (select id from current_pages)', $page_name, $role_ids)
  ));
  if(count($pages)==1)
  {
    $role_name = $pages[0]->role->name;
  }
  if(count($pages)==0)
  {
    $role_name = 'user';
  }
}

if(isset($role_name) && $role_name)
{
  $r = Role::find_by_name($role_name);
  if(!$r) redirect_to(view_page_url($page_name));
  
  $page = Page::find( array(
    'conditions'=>array('name = ? and role_id = ? and id in (select id from current_pages)', $page_name, $r->id)
  ));

  if($page==null)
  {
    $page = Page::new_model_instance( array(
      'attributes'=>array(
        'name'=>$page_name,
        'role_id'=>$r->id,
        'title'=>'New Page',
        'type'=>'html'
        )
    ));
  }
}

