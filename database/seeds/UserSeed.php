<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::insert('INSERT INTO users (id, name, email, password, admin, ativo, remember_token) VALUES(?,?,?,?,?,?,?)',
            array(
                2, 'Evaldo Avelar Marques', 'evaldoavelar@gmail.com', '$2y$10$hCguZQzEAJxdT4xyHkpQR.TnfItF86WQsP0OSAxQJCmkWXo6uUn2q', 1, 0, 'eMcwy7Sc5BszjzCf6kSKTA7k7zYUAnAj4H1JeNSGGQHk0DOlGuqtDb3XEOtB'
            ));

        DB::insert('INSERT INTO users (id, name, email, password, admin, ativo, remember_token) VALUES(?,?,?,?,?,?,?)',
            array(
                3, 'João', 'joao@stv.com.br', '$2y$10$rnavZLinLgY5dTXfp6wWTOp3W/5qdzWrbFOXaLBloKTw83arf5IaC', 0, 1, '2Gazp4ZDqIS0olsYCyv1GHWFZXB1wmO6yxmuP3SJc0BqYSmKCfUwWNNDtPj1'
            ));

        DB::insert('INSERT INTO users (id, name, email, password, admin, ativo, remember_token) VALUES(?,?,?,?,?,?,?)',
            array(
                4, 'Maria', 'maria@stv.com', '$2y$10$mcFKYANpWZL7EiHqxlUCNuiIckwmiK/tr5FOOIytStJeFaCnDtmhy', 0, 1, '9v89m582pODk3iVHaDMP5yhPbFjIDvLWli1ayCGuDvSKdNfa132Inx2bWW8A'
            ));

        DB::insert('INSERT INTO users (id, name, email, password, admin, ativo, remember_token) VALUES(?,?,?,?,?,?,?)',
            array(
                5, 'José', 'jose@stv.com.br', '$2y$10$brLyYKRZc10jYnq6V6SoSONHW/qJr3JbWX.80S9AgcT2WlVjrLrh6', 1, 1, 'huZh7Hwcj5hOMlt6knTU8hu9vEjHHdXZ1RmSia70fEMMYafEQyYb7VZn5PhL',
            ));

    }
}
