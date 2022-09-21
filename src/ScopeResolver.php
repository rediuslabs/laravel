<?php

namespace Redius;

use Redius\Exceptions\InvalidArgumentException;

class ScopeResolver
{
    public static function normalizeScopes(array $scopes): \Illuminate\Support\Collection
    {
        return collect($scopes)->map(function ($scope) {
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
