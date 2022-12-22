<?php

defined('ROOTPATH') OR die('ACCES DENIED');

/**
 * Misc Functions File
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package app
 * 
 */

function show(mixed $content) : void {
   echo "<pre>";
   var_dump($content);
   echo "</pre>";
}

function esc(string $string) : string {
   return htmlspecialchars($string);
}

function checkExtensions() : void {
   $requiredExtensions = [
      //todo: Nessesary Extensions list.
   ];
   $notLoaded = [];
   foreach($requiredExtensions as $extension) {
      if(!extension_loaded($extension)) {
         $notLoaded[] = $extension;
      }
   }
   if(!empty($notLoaded)) {
      die("Following PHP Extensions are missing: <br>" . implode("<br>", $notLoaded));
   }
}

function getImage(mixed $file = '', string $type = 'image') : string {
   $file = $file ?? '';
   if(file_exists($file)) {
      return ROOT . "/" . $file;
   }
      return THEME . "/images/misc/no_$type.png";
}

function redirect(string $destination) : void {
   if(!empty($destination)) {
      header("Location: " . ROOT . "/" . $destination);
   } else {
      header("Location: " . ROOT);
   }
}

function paginationVars() : array {
   $vars = [];
   $vars['page'] = $_GET['p'] ?? 1;
   $vars['page'] = (int) $vars['p'];
   $vars['prevPage'] = $vars['p'] <= 1 ? 1 : $vars['p'] - 1;
   $vars['nextPage'] = $vars['p'] + 1;
   return $vars;
}

function message(string $message, bool $clear) : mixed {
   $session = new Core\Session();
   if(!empty($message)) {
      $session->setSession('message', $message);
   } elseif(!empty($session->getSession('message'))) {
      $message = $session->getSession('message');
      if($clear) {
         $session->clearSession('message');
      }
      return $message;
   }
   return false;
}

function formCheckbox(string $key, string $value, string $default = "") : string {
   if(isset($_POST[$key])){
      if($_POST[$key] == $value) {
         return ' checked ';
      } else {
         if($_SERVER['REQUEST_METHOD'] === "GET" && $default === $value) {
            return ' checked ';
         }
      }
   }
   return "";
}

function formInput(string $key, mixed $default = "", string $mode = 'post') : mixed {
   $POST = ($mode === 'post') ? $_POST : $_GET;
   if(isset($POST[$key])) {
      return $POST[$key];
   }
   return $default;
}

function formSelect(string $key, mixed $value, mixed $default = "", string $mode = 'post') : string {
   if(isset($POST[$key])) {
      if($POST[$key] === $value) {
         return " selected ";
      } elseif($default === $value) {
         return " selected ";
      }
   }
   return "";
}

function formatDate($date) : string {
   return date("jS M, Y", strtotime($date));
}

function removeImages(string $content, string $directory = "uploads/") : string {
   if(!file_exists($directory)) {
      mkdir($directory, 0777, true);
      file_put_contents($directory . "index.php", "");
   }

   preg_match_all('/<img[^>]+/', $content, $matches);
   $newContent = $content;
   if(is_array($matches) && count($matches) > 0) {
      $image = new \Core\Image();
      foreach($matches[0] as $match) {
         if(strstr($match, "http")) {
            continue;
         }
         
         preg_match('/src="[^\"]+/', $match, $matches2);
         preg_match('/data-filename="[^\"]+/', $match, $matches3);

         if(strstr($matches2[0], 'data:')) {
            $parts = explode(",", $matches2[0]);
            $basename = $matches3[0] ?? 'basename.jpg';
            $basename = str_replace('data-filename="', "", $basename);
            $filename = $directory . "img_" . sha1((rand(0, 9999999999))) . $basename;
            $newContent = str_replace($parts[0] . "," . $parts[1], 'src="' . $filename, $newContent);
            file_put_contents($filename, base64_decode($parts[1]));

            $image->imageResize($filename, 1000);
         }
      }
   }
   return $newContent;
}

function deleteImages(string $content, string $newContent = "") : void {
   if(empty($newContent)) {
      preg_match_all('/<img[^>]+/', $content, $matches2);
      if(is_array($matches2) && count($matches2) > 0) {
         foreach($matches2[0] as $match) {
            $matches2[0] = preg_match('/src="', "", $matches2[0]);
            if(file_exists($matches2[0])) {
               unlink($matches2[0]);
            }
         }
      }
   } else {
      preg_match_all('/<img[^>]+/', $content, $matches);
      preg_match_all('/<img[^>]+/', $newContent, $newMatches);

      $oldImages = [];
      $newImages = [];

      if(is_array($matches) && count ($matches) > 0) {
         foreach($matches[0] as $match) {
            preg_match('/src=[^>"]+/', $match, $matches2);
            $matches2[0] = str_replace('src="', "", $matches2[0]);

            if(file_exists($matches2[0])) {
               $oldImages = $matches2[0];
            }
         }
      }
      if(is_array($newMatches) && count($newMatches) > 0) {
         foreach($newMatches[0] as $match) {
            preg_match('/src="', "", $matches2[0]);

            if(file_exists($matches2[0])) {
               $newImages[] = $matches2[0];
            }
         }
      }
      foreach($oldImages as $img) {
         if(file_exists($img)) {
            unlink($img);
         }
      }
   }
}

function addRootToImages(string $contents) : string {
   preg_match_all('/<img[^>]+/', $contents, $matches);
   if(is_array($matches) && count($matches) > 0) {
      foreach($matches[0] as $match) {
         preg_match('/src="[^"]+/', $match, $matches2);
         if(!strstr($matches2[0], 'http')) {
            $contents = str_replace($matches2[0], 'src="' . ROOT . '/' . str_replace('src="', "", $matches2[0]), $contents);
         }
      }
   }
   return $contents;
}

function URL($key) : mixed {
   switch($key) {
      case 'page':
      case 0:
         return APP('URL')[0] ?? null;
   }
}


checkExtensions();