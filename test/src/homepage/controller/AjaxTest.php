<?php
namespace homepage\controller;

/**
 * Ajax request tester
 */
class AjaxTest extends \ControllerTestCase {

    /**
     * Test the earliest movie I&#39;ve seen
     */
    public function testAjaxMoviesByYearPass() {
        $this->setUpController("/ajax-movies-by-year/1902", array());
        $this->assertJsonStringEqualsJsonString('{"movies":{"366":{"title":"Le Voyage Dans La Lune","title_en":"A Trip To The Moon","year":"1902","link":"http://www.imdb.com/title/tt0000417/"}}}', $this->response);
    }

    /**
     * Test boundary
     * @expectedException \xframe\request\InvalidParameterEx
     */
    public function testAjaxMoviesByYearBadParam() {
        $this->setUpController("/ajax-movies-by-year/1901");
    }

    /**
     * Test empty param
     * @expectedException \xframe\request\InvalidParameterEx
     */
    public function testAjaxMoviesByYearEmptyParam() {
        $this->setUpController("/ajax-movies-by-year/");
    }

    /**
     * Test valid genre
     */
    public function testAjaxMoviesAndSeriesByGenrePass() {
        $this->setUpController("/ajax-movies-and-series-by-genre/musical");
        $this->assertNotEmpty($this->response);
    }

    /**
     * Test wrong genre
     */
    public function testAjaxMoviesAndSeriesByGenreWrongParam() {
        $this->setUpController("/ajax-movies-and-series-by-genre/awesomeness");
        $this->assertJsonStringEqualsJsonString('{"error":"Nothing found :/"}', $this->response);
    }

    /**
     * Test empty param
     * @expectedException \xframe\request\InvalidParameterEx
     */
    public function testAjaxMoviesAndSeriesByGenreEmptyParam() {
        $this->setUpController("/ajax-movies-and-series-by-genre/");
    }

    /**
     * Test valid directors count
     */
    public function testAjaxMoviesByDirectorCountPass() {
        $this->setUpController("/ajax-movies-by-director-count/9");
        $this->assertNotEmpty($this->response);
    }

    /**
     * Test param boundary
     * @expectedException \xframe\request\InvalidParameterEx
     */
    public function testAjaxMoviesByDirectorCountBadParam() {
        $this->setUpController("/ajax-movies-by-director-count/101");
    }

    /**
     * Test empty param
     * @expectedException \xframe\request\InvalidParameterEx
     */
    public function testAjaxMoviesByDirectorCountEmptyParam() {
        $this->setUpController("/ajax-movies-by-director-count/");
    }

    /**
     * Test valid country
     */
    public function testAjaxMoviesAndSeriesByCountryPass() {
        $this->setUpController("/ajax-movies-and-series-by-country/norway");
        $this->assertNotEmpty($this->response);
    }

    /**
     * Test invalid country
     */
    public function testAjaxMoviesAndSeriesByCountryWrongParam() {
        $this->setUpController("/ajax-movies-and-series-by-country/atlantida");
        $this->assertJsonStringEqualsJsonString('{"error":"Nothing found :/"}', $this->response);
    }
}
