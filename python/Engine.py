'''

'''

class Engine():
	
	
	_RootNode = None
	
	
	'''
	
	'''
	def set_root_node(self, RootNode):
	
		''' TODO: Type check root node '''
		
		self._RootNode = RootNode
		return self
	
	
	'''
	
	'''
	def evaluate(self):
		
		if not self._RootNode:
			
			raise AttributeError('Root node must not be empty')
		
		return self._RootNode.evaluate()