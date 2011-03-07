<?

$r = Role::find_by_name('user');

$page = Page::new_model_instance( array(
  'attributes'=>array(
    'type'=>'html',
    'role_id'=>$r->id,
    )
));

$types = array(
  'markdown'=>'Markdown',
  'html'=>'HTML',
  'text'=>'Text',
  'php'=>'PHP'
);

$page->superform_sections = array(
  'basic'=>array(
    'type'=>array('type'=>'select', 'item_array'=>$types, 'autopostback'=>true),
    'title'=>array('type'=>'text', 'display'=>'required'),
    'name'=>array('type'=>'text', 'display'=>'required'),
    'body'=>array('type'=>'textarea', 'display'=>'required'),
  ),
  'options'=>array(
    'show_title'=>array('type'=>'check')
  )
);

if (is_postback())
{
  switch($params['superform_cmd'])
  {
    case 'refresh':
      $page->update_attributes($params['page'], false);
      break;
    case 'commit':
      $page->update_attributes($params['page']);
      $page->validate();
      if ($page->is_valid)
      {
        $page->save_as_new();
        flash_next('Text saved.');
        redirect_to(command_url('list'));
      }
  }
}

switch($page->type)
{
  case 'html':
    $page->superform_sections['basic']['body']['type'] = 'richtext';
    break;
}