interface Shape2D {
    public function getPerimeter();
    
    public function setPerimeter();
    
    public function getPerimeterFormula();
    
    public function getSurface();
    
    public function setSurface();
    
    public function getSurfaceFormula();
    
    public function getInteriorAngleSum();
    
    public function getInteriorAngleSumFormula();
    
    public function getExteriorAngleSum();
    
    public function getExteriorAngleSumFormula();
    
    public function getBarycenter();
    
    private function reset();
}