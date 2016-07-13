<?php
/**
 * Created by PhpStorm.
 * User: Evaldo
 * Date: 13/07/2016
 * Time: 10:03
 */

namespace App\Http\Controllers\Auth;


class Request
{

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        return redirect('/usuario-listar');
    }

}