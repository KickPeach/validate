# validate
校验请求参数，需要对抛出的一场进行捕捉处理

# 安装

    composer require kickpeach/validate
    
# 使用
```php

            $data = [
                'name'=>'111',
                'avatar'=>'',
            ];
    
            $rules = [
                'name'=>'required|lengthMax:2',
                'avatar'=>'required|url',
            ];
    
            $errors = [
                  'name.require'=>'名字不能为空'
            ];
    
            $data =  Validate::validated($data,$rules,$errors);

```

- 可以使用的rule，可查看Rule.php

# TODO

- [ ] 开发者可扩展自己的rule
- [ ] 支持使用匿名函数
