<?php

namespace Redius;

use Redius\Exceptions\InvalidArgumentException;

class ScopeResolver
{
    public static function normalize(array $scopes): \Illuminate\Support\Collection
    {
        return collect($scopes)->map(function ($scope, $key) {
            if (\is_string($scope) && \is_subclass_of($scope, Scope::class)) {
                $scope = new $scope(\is_string($key) ? $key : null);
            }

            // 'scopeName' => Scope::class
            if (is_string($scope) && class_exists($scope)) {
                $scope = new Scope($scope, \is_string($key) ? $key : $scope);
            }

            // 'scopeName' => fn() => 'code'
            if (\is_string($key) && $scope instanceof \Closure) {
                $scope = new Scope($scope, $key);
            }

            if (is_string($scope) || ($scope instanceof \Illuminate\Database\Eloquent\Scope && ! ($scope instanceof Scope))) {
                $scope = new Scope($scope);
            }

            // [Scope::class, 'scopeName'] or ['scopeName', Scope::class]
            if (is_array($scope) && count($scope) === 2) {
                if (is_string($scope[0])) {
                    [$scope, $label] = $scope;
                } else {
                    [$label, $scope] = $scope;
                }

                $scope = new Scope($scope, $label);
            }

            if (! $scope instanceof Scope) {
                throw new InvalidArgumentException('Invalid scope');
            }

            return $scope;
        });
    }
}
