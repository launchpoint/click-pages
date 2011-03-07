<?

function page_get_body_html($p)
{
  switch($p->type)
  {
    case 'html':
      return $p->body;
      break;
    case 'php':
      $md5 = md5($p->body);
      $fname = PAGES_CACHE_FPATH."/$md5.php";
      file_put_contents($fname, $p->body);
      return eval_php($fname);
      break;
    case 'markdown':
      return Markdown($p->body);
      break;
    case 'text':
      return simple_format(htmlentities($p->body));
      break;
    default:
      return 'Unsupported type '.$p->type;
  }
}