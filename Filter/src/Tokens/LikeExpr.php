<?php

namespace CP\Filter\Tokens;

class LikeExpr extends BinaryExpression
{
    public function apply($data): bool
    {
        $fieldValue = $this->left->apply($data);
        $matchString = $this->right->apply($data);

        return preg_match($this->toExpression($matchString), $fieldValue);
    }

    protected function toExpression($string): string
    {
        $value = str_replace(['%', '_'], ['.*?', '.'], preg_quote($string, '/'));
        return "/^{$value}$/i";
    }

}
