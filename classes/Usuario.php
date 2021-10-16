<?php
/*
	Classe Usuario
	*/
	class Usuario{
		
		/*
		Get List usuarios
		*/
		public function get(){
			$sql = "SELECT * FROM users";
			$stmt = DB::prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		/*
		Get usuario by id
		*/
		public function getOne($id){
			$sql = "SELECT * FROM users WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindValue(':id',$id);
			$stmt->execute();
			$result = $stmt->fetch();
			return $result;
		}

		/*
		Insert usuario
		*/
		public function insertUser($usuario){
			$sql = "INSERT INTO users (username, password, firstname, lastname, email) VALUES (:username, :password, :firstname, :lastname, :email)";
			$stmt = DB::prepare($sql);
			$stmt->bindParam("username", $usuario->username);
			$stmt->bindParam("password", $usuario->password);
			$stmt->bindParam("firstname", $usuario->firstname);
			$stmt->bindParam("lastname", $usuario->lastname);
			$stmt->bindParam("email", $usuario->email);
			$stmt->execute();
			$usuario->id = DB::lastInsertId();
			return $usuario;
		}

		/*
		Upadate usuario
		*/
		public function updateUser($usuario){
			$sql = "UPDATE users SET username=:username, password=:password, firstname=:firstname, lastname=:lastname, email=:email WHERE  id=:id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam("username", $usuario->username);
			$stmt->bindParam("password", $usuario->password);
			$stmt->bindParam("firstname", $usuario->firstname);
			$stmt->bindParam("lastname", $usuario->lastname);
			$stmt->bindParam("email", $usuario->email);
			$stmt->bindParam("id", $usuario->id);
			$stmt->execute();
			return $usuario;
		}

		/*
		Delete usuario
		*/
		public function deleteUser($id){
			$sql = "DELETE FROM users  WHERE  id=:id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
		}
	}