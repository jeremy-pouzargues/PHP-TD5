<?php

    class Cache
    {
        private $page;
        private $expiration;
        private $buffer;

        public function __construct($myPage)
        {
            $this->page = $myPage;
        }

        public function getPage()
        {
            return $this->page;
        }
        public function setPage($newPage)
        {
            $this->page = $newPage;
        }

        public function getExpiration()
        {
            return $this->expiration;
        }
        public function setExpiration($newExpiration)
        {
            $this->expiration = $newExpiration;
        }

        public function getBuffer()
        {
            return $this->buffer;
        }
        public function setBuffer($newBuffer)
        {
            $this->buffer = $newBuffer;
        }

        public function cacheView()
        {
            if (file_exists($this->page))
            {
                $heureFile = strtotime(date('YmdH', fileatime ($this->page)));
                $heureNow = strtotime(date('YmdH'));
                if ($heureNow == $heureFile)
                {
                    readfile($this->page);
                    exit();
                }
            }
        }
        public function startBuffer()
        {
            ob_start();
        }

        public function endBuffer()
        {
            $this->buffer = ob_get_contents();
            ob_end_clean();
            file_put_contents($this->page, $this->buffer);
            echo $this->buffer;
        }
    }


?>