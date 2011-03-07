   
CREATE VIEW current_pages AS select * from
  pages p
where
  p.id in (select max(pg.id) from pages pg where ((p.name = pg.name) and ((p.role_id = pg.role_id) or (isnull(p.role_id) and isnull(pg.role_id)))))