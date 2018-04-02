<?php
/* Smarty version 3.1.30, created on 2016-10-17 16:35:43
  from "D:\Pages\test\smarty\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58048d5fd3ada3_95349592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '850ce6a6edd6180f96e3bc1d6f30e2f6018bc400' => 
    array (
      0 => 'D:\\Pages\\test\\smarty\\templates\\index.tpl',
      1 => 1476686970,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58048d5fd3ada3_95349592 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '3187358048d5fcfdeb6_61278719';
?>


<hr>
<p>
单个变量例子:
Hello <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
, welcome to Smarty!
</p>
<hr>
<p>
数组指定下标输出：<br>
id:<?php echo $_smarty_tpl->tpl_vars['arr1']->value['id'];?>
,name:<?php echo $_smarty_tpl->tpl_vars['arr1']->value['name'];?>
<br>
id:<?php echo $_smarty_tpl->tpl_vars['arr2']->value['id'];?>
,name:<?php echo $_smarty_tpl->tpl_vars['arr2']->value['name'];?>
<br>
</p>
<hr>
<p>
数组循环输出：<br>

</p><?php }
}
