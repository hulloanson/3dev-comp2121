<?php

function hyphen_to_camel($hyphenated) {
  return preg_replace('/-/', '', $hyphenated);
}
