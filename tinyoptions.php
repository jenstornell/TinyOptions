<?php
class TinyOptions {
  public function setDefaults($defaults) {
    global $tiny_options_defaults;
    $tiny_options_defaults = $defaults;
  }

  private function getDefault($name) {
    global $tiny_options_defaults;
    if(isset($tiny_options_defaults[$name]))
      return $tiny_options_defaults[$name];
  }

  public function set($name, $value) {
    global $tiny_options;
    $tiny_options[$name] = $value;
  }

  public function get($name, $fallback = null) {
    global $tiny_options;
    
    if(isset($tiny_options[$name])) return $tiny_options[$name];
    if(isset($fallback)) return $fallback;
    return $this->getDefault($name);
  }

  public function unsetString($name) {
    global $tiny_options;

    if(isset($tiny_options[$name])) unset($tiny_options[$name]);
  }

  public function unsetArray($names) {
    foreach($names as $name) {
      $this->unsetString($name);
    }
  }
}

// HELPERS

class option {
  // option::set()
  public static function set($name, $value) {
    $TinyOptions = new TinyOptions();
    $TinyOptions->set($name, $value);
  }

  public static function unset($name) {
    $TinyOptions = new TinyOptions();
    $TinyOptions->unsetString($name);
  }
}

class options {
  // options::set()
  public static function set($options) {
    foreach($options as $name => $value) {
      option::set($name, $value);
    }
  }

  // options::default
  public static function default($defaults) {
    $TinyOptions = new TinyOptions();
    $TinyOptions->setDefaults($defaults);
  }

  public static function unset($names) {
    $TinyOptions = new TinyOptions();
    $TinyOptions->unsetArray($names);
  }
}

// option::get()
function option($name, $fallback = null) {
  $TinyOptions = new TinyOptions();
  return $TinyOptions->get($name, $fallback);
}