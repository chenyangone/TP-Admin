<?php
// +----------------------------------------------------------------------
// | TP-Admin [ 多功能后台管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2016 http://www.hhailuo.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 逍遥·李志亮 <xiaoyao.working@gmail.com>
// +----------------------------------------------------------------------

namespace Logic\Admin;
use Lib\Log;
use Logic\BaseLogic;

/**
 * 站点Logic
 */
class SiteLogic extends BaseLogic {

    public function getAccessibleSites() {
        $site_model = model('site', 'Admin');
        if (session(C('ADMIN_AUTH_KEY'))) {
            $sites = $site_model->select();
        } else {
            $sites = $site_model->getAccessibleSites();
        }
        return $sites;
    }

    public function setCache() {
        $sites = model('site', 'Admin')->select();
        $data  = [];
        foreach ($sites as $key => $val) {
            $data[$val['id']]        = $val;
            $url_parse               = parse_url($val['domain']);
            $data[$val['id']]['url'] = $url_parse['host'];
        }
        F('sitelist', $data);
        return $data;
    }

}