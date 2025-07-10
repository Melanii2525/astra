<?php
/**
 * @property CI_URI $uri
 */
function get_page_title() {
  $ci =& get_instance(); 
  $uri = $ci->uri->uri_string();

  $mapping = [
    'dashboard' => 'Dashboard',
    'pasal/pasal_16' => 'Pasal 16',
    'pasal/pasal_17' => 'Pasal 17',
    'pasal/pasal_18' => 'Pasal 18',
    'pasal/pasal_19' => 'Pasal 19',
    'pasal/pasal_20' => 'Pasal 20',
    'pasal/pasal_21' => 'Pasal 21',
    'pasal/pasal_22' => 'Pasal 22',
    'pasal/pasal_23' => 'Pasal 23',
    'pages/billing.html' => 'Input Pelanggaran',
    'pages/notifications.html' => 'Detail Pelanggaran',
    'pages/profile.html' => 'Profile',
    'pages/sign-in.html' => 'Sign In',
    'pages/sign-up.html' => 'Sign Up',
  ];

  return isset($mapping[$uri]) ? $mapping[$uri] : ucwords(str_replace(['_', '/'], ' ', $uri));
}