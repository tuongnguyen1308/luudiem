<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Duy Thành
 * Date: 12/09/2019
 * Time: 09:17 SA
 */
$data['url']  = base_url();
$data['currentUrl'] = str_replace(base_url(), '', current_url());
$data['session'] = getSession();
$data['message'] = getMessages();
// $data['myMenu'] = getSession('menu');
$data['csrf'] = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
$this->parser->parse('td_layouts/Vheader', $data);
$this->parser->parse($template, $data);
$this->parser->parse('td_layouts/Vfooter', $data);