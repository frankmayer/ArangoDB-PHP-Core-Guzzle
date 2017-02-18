<?php
/**
 *
 * File: GuzzleUnitTest.php
 *
 * @package
 * @author Frank Mayer
 */

namespace frankmayer\ArangoDbPhpCoreGuzzle\Tests\Unit;


use GuzzleHttp\Client;
use GuzzleHttp\Promise\EachPromise;
use Psr\Http\Message\ResponseInterface;

class GuzzleUnitTest extends ArangoDbPhpCoreGuzzleUnitTestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     *
     */
    public function setUp()
    {
        $this->client = new Client();

    }

    public function testIfGuzzleClientInstantiable()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function atestGuzzlePromisesOne()
    {

        $promise = $this->client->requestAsync('GET', 'https://api.github.com/users/frankmayer');

        $promise->then(function (ResponseInterface $response) {
            $profile = json_decode($response->getBody(), true);
            // Do something with the profile.
//            var_dump($profile);

        });

        $promise->wait();
    }

    public function atestGuzzlePromisesAll()
    {
        $promises  = [];
        $usernames = ['frankmayer', 'jsteemann'];

        foreach ($usernames as $username) {
            $promises[] = $this->client->requestAsync('GET', 'https://api.github.com/users/' . $username);
        }

        \GuzzleHttp\Promise\all($promises)->then(function (array $responses) {
            foreach ($responses as $response) {
                $profile = json_decode($response->getBody(), true);
                // Do something with the profile.
//                var_dump($profile);
            }
        })->wait();
    }


    public function atestGuzzlePromisesAllYield()
    {
        $usernames = ['frankmayer', 'jsteemann'];

        $promises = (function () use ($usernames) {
            foreach ($usernames as $username) {
                yield $this->client->requestAsync('GET', 'https://api.github.com/users/'.$username);
            }
        })(); // Self-invoking anonymous function (PHP 7 only), use call_user_func on older PHP versions.


        \GuzzleHttp\Promise\all($promises)->then(function (array $responses) {
            foreach ($responses as $response) {
                $profile = json_decode($response->getBody(), true);
                // Do something with the profile.
//                var_dump($profile);
            }
        })->wait();
    }

    public function atestGuzzlePromisesAllYieldEachPromise()
    {
        $usernames = ['frankmayer', 'jsteemann'];

        $promises = (function () use ($usernames) {
            foreach ($usernames as $username) {
                yield $this->client->requestAsync('GET', 'https://api.github.com/users/'.$username);
            }
        })(); // Self-invoking anonymous function (PHP 7 only), use call_user_func on older PHP versions.


        $a = new EachPromise($promises, [
            'concurrency' => 4,
            'fulfilled' => function (ResponseInterface $response) {
                $profile = json_decode($response->getBody(), true);
                // Do something with the profile.
                var_dump($profile);
            },
        ]);
        $a->promise()->wait();
    }


    public function atestGuzzlePromisesAllYieldEachPromiseAdvance()
    {
        $usernames = ['frankmayer', 'jsteemann'];

        $promises = (function () use ($usernames) {
            foreach ($usernames as $username) {
                yield $this->client->requestAsync('GET', 'https://api.github.com/users/'.$username);
            }
        })(); // Self-invoking anonymous function (PHP 7 only), use call_user_func on older PHP versions.


        $a = new EachPromise($promises, [
            'concurrency' => 4,
            'fulfilled' => function (ResponseInterface $response) {
                $profile = json_decode($response->getBody(), true);
                // Do something with the profile.
                $this->helper($profile);
            },
        ]);
        $a->promise()->wait();



        echo " end";
    }

    public function helper($response)

    {
        var_dump($response);

    }
}