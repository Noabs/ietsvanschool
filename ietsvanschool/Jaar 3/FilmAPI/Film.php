<?php

class Film{
    public $id;
    public $titel;
    public $speelduur;
    public $kijkwijzer;
    public $genre;

    public function setid($id) {
        $this->id = $id;
      }
      
      public function getid() {
        return $this->id;
      }

    public function settitel($titel) {
        $this->titel = $titel;
      }
      
      public function gettitel() {
        return $this->titel;
      }
      
    public function setspeelduur($speelduur) {
        $this->speelduur = $speelduur;
      }
      
      public function getspeelduur() {
        return $this->speelduur;
      }
      
    public function setkijkwijzer($kijkwijzer) {
        $this->kijkwijzer = $kijkwijzer;
      }
      
      public function getkijkwijzer() {
        return $this->kijkwijzer;
      }
      
    public function setgenre($genre) {
        $this->genre = $genre;
      }
      
      public function getgenre() {
        return $this->genre;
      }
}