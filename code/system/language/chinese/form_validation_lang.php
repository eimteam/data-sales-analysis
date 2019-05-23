<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '{field}字段是必需的.';
$lang['form_validation_isset']			= '{field}字段必须有值.';
$lang['form_validation_valid_email']		= '{field}字段必须包含有效的电子邮件地址.';
$lang['form_validation_valid_emails']		= '{field}字段必须包含所有有效的电子邮件地址.';
$lang['form_validation_valid_url']		= '{field}字段必须包含有效的网址.';
$lang['form_validation_valid_ip']		= '{field}字段必须包含有效的IP.';
$lang['form_validation_valid_base64']		= '{field}字段必须包含有效的Base64字符串.';
$lang['form_validation_min_length']		= '{field}字段的长度必须至少为{param}个字符.';
$lang['form_validation_max_length']		= '{field}字段的长度不能超过{param}字符.';
$lang['form_validation_exact_length']		= '{field}字段的长度必须是{param}字符';
$lang['form_validation_alpha']			= '{field}字段可能只包含字母、字符.';
$lang['form_validation_alpha_numeric']		= '{field}字段只能包含字母、数字、字符.';
$lang['form_validation_alpha_numeric_spaces']	= '{field}字段只能包含字母、数字、字符和空格.';
$lang['form_validation_alpha_dash']		= '{field}字段可能只包含字母、数字、字符、下划线和短划线.';
$lang['form_validation_numeric']		= '{field}字段必须只包含数字.';
$lang['form_validation_is_numeric']		= '{field}字段必须只包含数字、字符.';
$lang['form_validation_integer']		= '{field}字段必须包含整数.';
$lang['form_validation_regex_match']		= '{field}字段的格式不正确.';
$lang['form_validation_matches']		= '{field}字段与{param}字段不匹配.';
$lang['form_validation_differs']		= '{field}字段必须与{param}字段不同.';
$lang['form_validation_is_unique'] 		= '{field}字段必须包含唯一值.';
$lang['form_validation_is_natural']		= '{field}字段必须只包含数字.';
$lang['form_validation_is_natural_no_zero']	= '{field}字段必须只包含数字,且必须大于0.';
$lang['form_validation_decimal']		= '{field}字段必须包含十进制数.';
$lang['form_validation_less_than']		= '{field}字段必须包含小于{param}的数字.';
$lang['form_validation_less_than_equal_to']	= '{field}字段必须包含小于或等于{param}的数字';
$lang['form_validation_greater_than']		= '{field}字段必须包含大于{param}的数字.';
$lang['form_validation_greater_than_equal_to']	= '{field}字段必须包含大于或等于{param}的数字.';
$lang['form_validation_error_message_not_set']	= '无法访问与您的字段名{field}对应的错误消息.';
$lang['form_validation_in_list']		= '{field}字段必须是以下之一:{param}.';
