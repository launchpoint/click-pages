<?

$pages = Page::find_all( array(
  'conditions'=>array('id in (select id from current_pages)'),
  'order'=>'name'
));
