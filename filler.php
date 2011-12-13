<?php

/*
 * @title:  Flood Fill Class
 * See below class for example input.
 */
class FloodFiller {
 
    private $x, $y, $fill, $searchNext, $map;
 
    public function Scan( $map, $point ) {
        // We create the list of traversable squares(fill)
        // and a to-search queue(searchNext[])
        // where we insert our starting point.
        $this->map          = $map;
        $this->fill         = array();
        $this->searchNext   = array();
        $this->searchNext[] = array('x' => $point[ 'x' ], 'y' => $point[ 'y' ]);
 
        // As long as there are items in the queue
        // keep filling!
        while ( !empty( $this->searchNext ) ) {
 
            // Get the next square item and erase it from the list  
            $next = array_pop( $this->searchNext );
            $this->x = $next[ 'x' ];
            $this->y = $next[ 'y' ];
 
            // Check square. If it's traversable we add
            // the square to our fill list and we turn the
            // square untraversable to prevent future checking.
            if ( $this->map[ $this->x ][ $this->y ] == 1 ) {
                $this->map[ $this->x ][ $this->y ] = 0;
                $this->fill[] = array( 'x' => $this->x, 'y' => $this->y );
                $this->CheckDirections();
 
            }
        }
        return $this->fill;
    }
    private function CheckSquare( $checkX, $checkY ) {
        // if we can fill this square we add it to our queue
        if ( $this->map[ $checkX ][ $checkY ] == 1 ) {
            $this->searchNext[] = array( 'x' => $checkX, 'y' => $checkY );    
        }
    }
    private function CheckDirections() {
        // Perform a check of all adjacent squares
        $this->CheckSquare( $this->x, $this->y - 1 );
        $this->CheckSquare( $this->x, $this->y + 1 );
        $this->CheckSquare( $this->x - 1, $this->y );
        $this->CheckSquare( $this->x + 1, $this->y );
    }
}
 
// Example Input:
// 6×6 map
// 1: valley
// 0: mountain/sea
// Starting Point: 3.3
$map = array(
               //0  1  2  3  4  5
    array( /*0*/ 1, 0, 1, 0, 1, 0 ),
    array( /*1*/ 0, 1, 1, 0, 1, 0 ),
    array( /*2*/ 1, 1, 1, 1, 0, 0 ),
    array( /*3*/ 1, 1, 0, 1, 1, 1 ),
    array( /*4*/ 0, 0, 1, 1, 1, 0 ),
    array( /*5*/ 1, 0, 1, 0, 0, 0 )
    );
 
// Starting Point: 3.3
$point = array ( 'x' => 3, 'y' => 3 );
 
// new class instance
$floodFiller = New FloodFiller();
 
// Print the final list of filled coordinates
print_r( $floodFiller->Scan( $map, $point ) );

?>